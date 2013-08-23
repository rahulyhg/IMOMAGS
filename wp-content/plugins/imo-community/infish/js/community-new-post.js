jQuery(document).ready(function($) {

	//Get post_type from community config
	var postTypes = IMO_COMMUNITY_CONFIG.post_types;

	postAttachments = [];
	postData = [];

	//*******************************************************
	//****************** DISPLAY THE FORM *******************
	//*******************************************************
	var formTemplate = _.template( $("#new-post-template").html() , { post:null, post_types:postTypes } );//Use the post types from the configuration
	$("#form-container").append(formTemplate);

	//*******************************************************
	//****************** CHECK FOR IMAGE *******************
	//*******************************************************
	if (window.location.hash) {
		var imageID = window.location.hash.substring(1);
		var imgURL = "https://www.filepicker.io/api/file/" + imageID ;

		var newAttachment = {};

		newAttachment.img_url = imgURL;

		//get template for attachment
        var attachmentTemplate = _.template( $("#single-attachment-template").html() , {attachment: newAttachment} );
        var $attachmentTemplate = $(attachmentTemplate);


        //display attachment
        $attachmentTemplate.hide().appendTo("#attachments").slideDown();

        //hide the attach photo button
        $(".photo-link-area").slideUp;

        //Track the data
        postData.img_url = FPFile.url;

        //add event to edit caption on change
        $attachmentTemplate.find(".caption-field").change(function(ev){
        	var caption = ev.currentTarget.value;
        	postData.body = caption;
        });

        //Add Event to Delete Attachment
        $attachmentTemplate.find(".delete-attachment").click(function(ev){

        	ev.preventDefault();

        	$(".add-photo-link").slideDown();


        	$attachmentTemplate.slideUp();

        });

	}


	//*******************************************************
	//****************** NEW POST SUBMISSION ****************
	//*******************************************************
	$("#new-post-form").submit(function(){

		var formDataObject = $("#new-post-form").formParams();
		var newPostData = $.extend(formDataObject,userIMO,postData);

		newPostData.attachments = postAttachments;

		//console.log(newPostData);

		$.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

			var postData = $.parseJSON(data);




			//alert("New Post Added! Replace this alert with a redirect to something!")

			window.location.href = "/photos/" + postData.id;
		});

		return false;

	});

	//*******************************************************
	//************* HANDLE SELECT DROPDOWNS *****************
	//*******************************************************


	//*******************************************************
	//****************** UPLOAD IMAGES **********************
	//*******************************************************
	$("#new-post-form #image-upload").change(function(ev){//After the user selects a file

		var fileInput = ev.currentTarget;

		if (!fileInput.value) {
			//If they don't select anything... Do nothing
		    //console.log("Choose an Image to upload.");
		} else {

			$('#progressBar').fadeIn();

			filepicker.setKey('ANCtGPesfQI6nKja0ipqBz');

		    filepicker.store(fileInput, function(FPFile){//Begin the upload


		    		//If upload is good:
		            //console.log("Store successful:", FPFile);

		            //Create the attachment data

		            var newAttachment = {};
		            newAttachment.img_url = FPFile.url;
		            newAttachment.post_type = "photo";


		            //get template for attachment
		            var attachmentTemplate = _.template( $("#single-attachment-template").html() , {attachment: newAttachment} );
		            var $attachmentTemplate = $(attachmentTemplate);


		            //display attachment
		            $attachmentTemplate.hide().appendTo("#attachments").slideDown();

		            //add event to edit caption on change
		            $attachmentTemplate.find(".caption-field").change(function(ev){
		            	var caption = ev.currentTarget.value;
		            	postData.body = caption;
		            });

		            //Add Event to Delete Attachment
		            $attachmentTemplate.find(".delete-attachment").click(function(ev){

		            	ev.preventDefault();

		            	$(".add-photo-link").slideDown();


		            	$attachmentTemplate.slideUp();

		            });

		            //Hide Attachment Button
		            $(".add-photo-link").slideUp();

		            //postAttachments.push(newAttachment);//add the attachments to the list
		            postData.img_url = FPFile.url;
					$('#progressBar').slideUp();

		        }, function(FPError) {
		            //console.log(FPError.toString());
		        }, function(progress) {
		        	//upload progress
		            //console.log("Loading: "+progress+"%");//PROGRESS INDICATOR!!!!!

		            //progress bar
		            $('#progressBar div').css("width",progress*3 + "px");
		            $('#progressBar span').text("Uploading: "+progress+"%");

		        }
		   );

		}
	});



});

