<?php
header('Content-type: application/json');

include 'mysql.php';

$siteID["www.gunsandammo.com"] = 2;
$siteID["www.handgunsmag.com"] = 9;
$siteID["www.shootingtimes.com"] = 11;
$siteID["www.rifleshootermag.com"] = 10;
$siteID["www.shotgunnews.com"] = 12;
$siteID["www.bowhunter.com"] = 3;
$siteID["www.bowhuntingmag.com"] = 4;
$siteID["www.gundogmag.com"] = 5;
$siteID["www.northamericanwhitetail.com"] = 6;
$siteID["www.petersenshunting.com"] = 7;
$siteID["www.wildfowlmag.com"] = 8;
$siteID["www.gameandfishmag.com"] = 14;
$siteID["www.floridasportsman.com"] = 13;
$siteID["www.in-fisherman.com"] = 15;
$siteID["www.flyfisherman.com"] = 16;


$domain = $_SERVER['HTTP_HOST'];

$domain = str_replace(".deva", ".com", $domain);
$domain = str_replace(".fox", ".com", $domain);
$domain = str_replace(".salah", ".com", $domain);
$domain = str_replace(".devb", ".com", $domain);
$domain = str_replace(".devc", ".com", $domain);


$currentSiteID = $siteID[$domain];

$query = "";


$count = intval($_REQUEST['count']);
$skip = intval($_REQUEST['skip']);

$searchParameter = $_GET['term'];

try {

    $db = dbConnect();


        $query = "SELECT
            posts.ID as id,
            posts.post_title as title,
            posts.post_title as label,
            posts.post_title as value,
            posts.post_type as type,
            posts.post_content as post_content,
            attachmentmeta.meta_value as attachment_meta,
            posts.guid as url
            FROM wp_{$currentSiteID}_posts posts
            JOIN wp_{$currentSiteID}_postmeta as postmeta ON (posts.ID = postmeta.post_id)
            JOIN wp_{$currentSiteID}_posts as attachments ON (attachments.ID = postmeta.meta_value)
            JOIN wp_{$currentSiteID}_postmeta as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
            WHERE posts.post_title LIKE ?
            AND posts.post_type IN ('post','reviews')
            AND posts.post_status = 'publish'
            AND postmeta.meta_key = '_thumbnail_id'
            AND attachmentmeta.meta_key = '_wp_attachment_metadata'
            ORDER BY posts.post_date DESC LIMIT 0,10";


    $stmt = $db->prepare($query);

    $stmt->execute(array("%$searchParameter%"));

    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

    $db = "";

    foreach ($posts as $key => $post) {

        $thumb = getThumbnail(unserialize($post->attachment_meta));

        $posts[$key]->thumb = $thumb;
        $posts[$key]->attachment_meta = unserialize($posts[$key]->attachment_meta);

         //First Clean up the data
        $postContent = trim(strip_tags($post->post_content));
        $postContent = preg_replace('/\[[^\)]+\]/', "", $postContent);
        $postContent = str_replace("\n", "", $postContent);
        $postContent = str_replace("\r", "", $postContent);
        $postContent = str_replace("\xe2", "", $postContent);
        $postContent = str_replace("\x80", "", $postContent);
        $postContent = str_replace("\x9d", "", $postContent);
        $postContent = str_replace("\x99", "", $postContent);
        $postContent = str_replace("\x9c", "", $postContent);
        $postContent = str_replace("\x94", "", $postContent);
        $postContent = str_replace("\xa6", "", $postContent);
        $postContent = str_replace("\\", "", $postContent);
        $postContent = str_replace("\x93", "", $postContent);
        $postContent = str_replace("\xa8", "", $postContent);
        $postContent = str_replace("\\", "", $postContent);
        $postContent = str_replace("\\", "", $postContent);
        $postContent = preg_replace ("/^\[.+]/", "", $postContent);
        //$postContent = delete_all_between("[","]",$postContent);

        $postContent = substr($postContent,0,120) . "...";
        $posts[$key]->post_content = $postContent;


    }

    echo json_encode($posts);

} catch(PDOException $e) {
    echo $e->getMessage();
}


function getThumbnail($dataArray) {

    $filepath = $dataArray['file'];

    $filepathParts = explode("/",$filepath);



    $filename = $dataArray['sizes']['list-thumb']['file'];

    $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

    if (empty($filename)) {
        $fullPath = "/files/" . $filepath;
    }



    return $fullPath;
}


