window.fbAsyncInit = function() {
  FB.init({
    appId      : '127971893974432',
    status     : true, 
    cookie     : true,
    xfbml      : true,
    oauth      : true,
  });
  FB.Event.subscribe('auth.login', function (response) {
      console.log("HEY THERE!");
      console.log(response);
      jQuery.getJSON('/facebook-usercheck.json', function(data) {
	   		console.log(data);
	   });
  }, {scope: 'email,user_likes'});
};
(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));

