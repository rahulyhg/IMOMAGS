<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$DOMAIN = "deva";

require 'Slim/Slim.php';

$app = new Slim();
include 'mysql.php';
include 'auth.php';
include 'userinfo.php';
include 'images.php';
include 'video.php';
include 'location.php';

function get_IP() {
	$headers = apache_request_headers(); 
	$XFFip = $headers["X-Forwarded-For"];

	if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")
		return $XFFip;
	else
		return $_SERVER['REMOTE_ADDR'];

}

$response = $app->response();
$response['Content-Type'] = 'application/json';



$app->get('/',function(){
	echo "<h1>Hello Berry!</h1>";
});





//*********************************
//********* Get all Posts *********
//*********************************
//Note, this does not fetch comments or answers
$app->get('/api/superpost/all(/:count(/:start))',function($count = 20,$start = 0){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();

		$limitClause = "LIMIT $start,$count";

		$sql = "SELECT * FROM allcounts ORDER BY id DESC $limitClause";
		$stmt = $db->query($sql);
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//*********************************
//**** Get all Posts of a Type ****
//*********************************
$app->get('/api/superpost/type/:post_type(/:count(/:start))',function($post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";

		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube'";

		$limitClause = "LIMIT $start,$count";


		$sql = "SELECT * FROM allcounts $whereClause ORDER BY id DESC $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});



//*********************************
//*** Get Specific Post with ID ***
//*********************************
$app->get('/api/superpost/post/:id',function($id){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM allcounts WHERE id = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//**************************************
//**** Get all Child Posts of a Type ***
//**************************************
$app->get('/api/superpost/children/:post_type/:parent_id',function($post_type,$parent_id){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		if ($post_type != "not_comment") {

			$sql = "SELECT * FROM superposts WHERE post_type = ? AND parent = ? ORDER BY id ASC";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($post_type,$parent_id));
		} else { //If post_type == not_comment
			
			$sql = "SELECT * FROM superposts WHERE post_type != 'comment' AND parent = ? ORDER BY id ASC";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($parent_id));
		}
		
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//**************************************
//**** Get Comments with attachments ***
//**************************************
$app->get('/api/superpost/comment_attachments/:parent_id',function($parent_id){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();



		$sql = "SELECT posts.ID post_id, posts.gravatar_hash gravatar_hash,
				comments.ID comment_id, comments.post_type comment_post_type, comments.body comment_body, comments.username comment_username,
				attachments.ID attachment_id, attachments.post_type attachment_post_type, attachments.img_url as attachment_img_url, attachments.meta as attachment_meta, attachments.body as attachment_body 
				FROM superposts as posts
				LEFT JOIN superposts as comments ON posts.id = comments.parent
				LEFT JOIN superposts as attachments ON comments.id = attachments.parent
				WHERE posts.ID = ?
				AND comments.post_type = 'comment'";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($parent_id));

	
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		$postComments = array();
		$comment = array();
		$comment['comment_id'] = 0;
		foreach ($posts as $post) {

			
			if ($post->comment_id != $comment['comment_id'])
				$comment['attachments'] = array();

			
			$attachmentID = $post->attachment_id;
			
			$comment['comment_id'] = $post->comment_id;
			$comment['comment_body'] = $post->comment_body;
			$comment['comment_username'] = $post->comment_username;
			$comment['gravatar_hash'] = $post->gravatar_hash;

			if ($post->attachment_id) {
				$comment['attachments'][$attachmentID]['attachment_img_url'] = $post->attachment_img_url;
				$comment['attachments'][$attachmentID]['attachment_body'] = $post->attachment_body;
				$comment['attachments'][$attachmentID]['attachment_post_type'] = $post->attachment_post_type;
				$comment['attachments'][$attachmentID]['attachment_meta'] = $post->attachment_meta;
			}
				



			$postComments[$post->comment_id] = $comment;


		}



		echo json_encode($postComments);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});


//*********************************
//**********Add new Posts**********
//*********************************
$app->post('/api/superpost/add',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("NEW POST STARTED!");
	_log( $params);


	//Get the user info an authenticate
	if (userIsGood($params['username'],$params['userhash'])) {
	
	_log("USER IS GOOD");

		//Set additional parameters
		$params['ip'] = ip2long(get_IP());

		//error_log($params);

		//Handle the uploaded file
		if (!empty($_FILES['photo-upload']['name'])) {
			$fileName = $_FILES['photo-upload']['name'];
			$tmpName = $_FILES['photo-upload']['tmp_name'];
			$target_path = "images/tmp/";
			$target_path = $target_path . basename( $fileName );

		}
		/////////////////////////////////////
		//If there is a video....
		$videoExists = false;
		if ($params['post_type'] == "youtube") {

			_log("VIDEO STUFF");
			_log($params);

			$videoID = extractVideoID($params['body']);

			$video = getYoutubeVideo($videoID);

			$params['body'] = "";
			$params['meta'] = $videoID;

			$target_path = $video['temp_image_path'];

			_log($video);

			$imgURL = resizeImages($target_path, TRUE);

			$videoExists = TRUE;

		}

		 /////////////////////////////////////
		//If there is an image
		if (!empty($_FILES['photo-upload']['name'])) { //Check if file exists
			if(move_uploaded_file($tmpName, $target_path)) { //check if file upload failed
				//Then resize and move the file!
				$imgURL = resizeImages($target_path);
			} else{
			    error_log("There was an error uploading the file, please try again!");
			}
		}

		/////////////////////////////////////
		//If there are attachments, get the $imgURL
		if (!empty($params['attachment_id'])) {
			$attachmentIDstring = $params['attachment_id'];
			$attachmentIDs = explode(",", $attachmentIDstring);
		

			$imgURL = getImgURL($attachmentIDs[0]);
			$params['img_url'] = $imgURL;
			
			
		}

		
	
		$paramList = array(
			"parent",
			"post_type",
			"title",
			"body",
			"user_id",
			"username",
			"gravatar_hash",
			"img_url",
			"ip",
			"meta",
			"state",
			"video_url"
		);

		if (!empty($fileName) || $videoExists) {
			$params['img_url'] = $imgURL;
		}
		
		$db = dbConnect();

		//BUILD THE PERFECT QUERY FOR THE PARAMETERS GIVEN
		$sql = "INSERT INTO superposts (";
		$sql2 = "VALUES (";

		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$sql .= $parameter . ",";
				$sql2 .= ":$parameter,";
			}
		}

		$sql = substr_replace($sql ,"",-1);
		$sql2 = substr_replace($sql2 ,"",-1);

		$sql .= ") ";
		$sql2 .= ")";

		$sql = $sql . $sql2;

		$stmt = $db->prepare($sql);



		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$stmt->bindParam($parameter,$params[$parameter]);
			}
		}


		//THIS IS THE END RESULT OF THE ABOVE LOOP MADNESS:
		//$sql = "INSERT INTO superposts (parent, post_type, title, body, img_url, author_id, author, gravatar_hash) 
		//                       VALUES (:parent,:post_type,:title,:body,:img_url,:author_id,:author,:gravatar_hash)";

		// $stmt->bindParam("parent",$params['parent']);
		// $stmt->bindParam("post_type",$params['post_type']);
		// $stmt->bindParam("title",$params['title']);
		// $stmt->bindParam("body",$params['body']);
		
		// $stmt->bindParam("user_id",$params['user_id']);
		// $stmt->bindParam("username",$params['username']);
		// $stmt->bindParam("gravatar_hash",$params['gravatar_hash']);


			

        $stmt->execute();
        $superpostID = $db->lastInsertId();
        
        
        //If there are attachments, set the parent of the attachemnts
     	if (!empty($params['attachment_id'])) {
			$attachmentIDstring = $params['attachment_id'];
			setAtttachment($superpostID, $attachmentIDstring);
			
		}
        

		$db = "";

		$params['id'] = $superpostID;
		$params['ip'] = long2ip($params['ip']);


		$response = $params;

		
		echo json_encode($response);

	
	} else { //if user is not good
		_log("USER IS BAD");
		json_encode("nope");
	}
	


});


//*********************************
//**********Update Post Body**********
//*********************************
$app->post('/api/superpost/update_caption',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("NEW CAPTION STARTED");
	_log($params);

	$newBody = $params['body'];
	$post_id = $params['post_id'];


	//Get the user info an authenticate
	if (userIsGood($params['username'],$params['userhash'])) {

		try {

			$db = dbConnect();


			$sql = "UPDATE superposts SET `body` = ? WHERE `id` = ?";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($newBody,$post_id));
		
		

			echo json_encode("GOOD");

			$db = "";

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }

	}



});





function setAtttachment($spid,$attachmentIDstring) {
	try {

		$attachIDs = explode(",", $attachmentIDstring);

		$db = dbConnect();


		foreach ($attachIDs as $attachmentID) {
			$sql = "UPDATE superposts SET parent = ? WHERE id IN(?)";

			$stmt = $db->prepare($sql);

			$stmt->execute(array($spid,$attachmentID));
		
			$row = $stmt->fetch(PDO::FETCH_OBJ);			
		}







		$db = "";
		
		return true;


	} catch(PDOException $e) {
    	echo $e->getMessage();
    	return false;
    }
	
}


function getImgURL($spid) {
	try {

		$db = dbConnect();


		$sql = "SELECT img_url FROM superposts WHERE id = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($spid));
	
		$row = $stmt->fetch(PDO::FETCH_OBJ);

		$db = "";
		
		return $row->img_url;


	} catch(PDOException $e) {
    	echo $e->getMessage();
    }
}






/* Better Logging Function */
if(!function_exists('_log')){
  function _log( $message ) {
	  if( is_array( $message ) || is_object( $message ) ){

	  	$errorString = print_r( $message, true );

	    error_log( "$errorString",0);
	  } else {
	    error_log( $message );
	  }
  	}
}






$app->run();