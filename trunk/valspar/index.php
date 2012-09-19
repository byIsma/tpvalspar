<?php

require './facebook/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '492668300762232',
  'secret' => 'b637c96d95926c23f6d38835296951ac',
));

// Get User ID
$user = $facebook->getUser();
function ShareImage()
{			
if($user)
{
      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        $ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'apps.facebook.com/valspar/',
									  'source' => 'http://valspar.thetigerparty.com/Valspar/img/sample001.jpg' ,
                                      'message' => 'Share a Image from Valspar',
									  'description' => 'Share a Image from Valspar'
                                 ));
//        echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_stream'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } 
	else
	{

      // No user, so print a link for the user to login
      // To post to a user's wall, we need publish_stream permission
      // We'll use the current URL as the redirect_uri, so we don't
      // need to specify it here.
      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream' ) );
      echo 'Please <a href="' . $login_url . '">login.</a>';

    } 						
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <script src="js/jquery-latest.js"></script>
        <script type="text/javascript">

			window.fbAsyncInit = function()
			{
				FB.init(
				{
					appId      : '492668300762232', // App ID
					//channelUrl : '//apps.facebook.com/channel.html', // Channel File
					status     : true, // check login status
					cookie     : true, // enable cookies to allow the server to access the session
					xfbml      : true  // parse XFBML
				});
			};
			// Load the SDK Asynchronously
			(function(d)
			{
				var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement('script'); js.id = id; js.async = true;
				js.src = "//connect.facebook.net/en_US/all.js";
				ref.parentNode.insertBefore(js, ref);
			}(document));		
	
	
/*
			function getQueryString( paramName )
			{ 
				paramName = paramName .replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]").toLowerCase(); 
				var reg = "[\\?&]"+paramName +"=([^&#]*)"; 
				var regex = new RegExp( reg ); 
				var regResults = regex.exec( location.href.toLowerCase() ); 
				if( regResults == null ) return ""; 
				else return regResults [1]; 
			} 
*/
			if( location.search.indexOf("GetDC") == -1 )
			{
				var oauth_url = 'https://www.facebook.com/dialog/oauth/';
				oauth_url += '?client_id=492668300762232';
				oauth_url += '&redirect_uri=' + encodeURIComponent('https://valspar.thetigerparty.com/Valspar/');
				oauth_url += '&scope=publish_stream';
				oauth_url += '&state=GetDC';
				window.top.location = oauth_url;
			}
			else if( location.search.indexOf("AfterGetDC") == -1 )
			{
				var oauth_url = 'https://www.facebook.com/dialog/oauth/';
				oauth_url += '?client_id=492668300762232';
				oauth_url += '&redirect_uri=' + encodeURIComponent('https://apps.facebook.com/valspar/');
				oauth_url += '&scope=publish_stream';
				oauth_url += '&state=AfterGetDC';
				window.top.location = oauth_url;
			}
				var ID = 1;

			$(document).ready(function(e)
			{
				$("a[id^='Img']").click(function(e)
				{
					ID = this.id.substring(4);
					$('.item').attr("src","http://valspar.thetigerparty.com/Valspar/img/sample00"+ID+".jpg");
				});

				$("#EMShare").click(function(e)
				{
					window.open( "mailto:?subject=Share Image from Valspar&body=<img scr=\""+$('.item').attr("src")+"\" /><br/>Share from Valspar https://apps.facebook.com/valspar/");
				});

				$("#FBShare").click(function(e)
				{
					var result = FB.ui(
					{
						method: 'feed',
						name: 'Valspar Share',
						link: 'https://apps.facebook.com/valspar',
						picture: $('.item').attr("src"),
						caption: 'Share Image From Valspar',
//						description: 'Share Image From Valspar'
					},
					function(response)
					{
						if (response && response.post_id)
						{
//							alert('Post was published.');
							FB.api('/me', function(response)
							{
								alert(response.name);
							});
							FB.getLoginStatus(function(response)
							{
								 response;
							});
						}
						else
						{
//							alert('Post was not published.');
							FB.api('/me', function(response)
							{
								alert(response.name);
							});
							FB.getLoginStatus(function(response)
							{
								 response;
							});
						}
					});							
//*/

				});
				$("#TWShare").click(function(e)
				{
					window.open( "https://valspar.thetigerparty.com/Valspar/twitter/index.php?ID="+ID, "Share Twitter",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=300');
/*					var xmlhttp;
					if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}
					else
					{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					alert(ID);
					var params = "ID=" + ID;
					
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							if( xmlhttp.responseText == "200" )
								alert( "Share Image To Twitter Success!!" );
							else
								alert( xmlhttp.responseText );
							
						}
					}
					xmlhttp.open("POST","https://valspar.thetigerparty.com/Valspar/twitter/index.php",true);
					
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.setRequestHeader("Content-length", params.length);
					xmlhttp.setRequestHeader("Connection", "close");

					xmlhttp.send( params );	
*/				
				});
			});
			
        </script>
<title>Valspar</title>
</head>

<body>

<div class="SliderImage" align="center">
	<div class="slider" style="width:800px; height:600px; overflow:hidden">
		<img class="item" src="http://valspar.thetigerparty.com/Valspar/img/sample001.jpg" id="Img001"/>
		<!--img class="item" src="img/sample002.jpg" id="Img002"/>
		<img class="item" src="img/sample003.jpg" id="Img003"/>
		<img class="item" src="img/sample004.jpg" id="Img004"/>
		<img class="item" src="img/sample005.jpg" id="Img005"/-->
	</div>
    <div style="width:800px">
    	<div style="float:left;"><a type="button" id="Img01"><img src="img/button001.jpg"/></a></div>
    	<div style="float:left;"><a type="button" id="Img02"><img src="img/button002.jpg"/></a></div>
    	<div style="float:left;"><a type="button" id="Img03"><img src="img/button003.jpg"/></a></div>
    	<div style="float:left;"><a type="button" id="Img04"><img src="img/button004.jpg"/></a></div>
    	<div style="float:left;"><a type="button" id="Img05"><img src="img/button005.jpg"/></a></div>
    </div>
    
    <div style="width:800px">
    	<div style="float:left;padding-left:14%;">
        	<a type="button" id="EMShare"><img src="img/mail_share.jpg" style="height:48px;"/></a>
        	<!--input type="button" id="FBShare" value="Share To Facebook"/-->
        </div>
    	<div style="float:left;padding-left:14%;">
        	<a type="button" id="FBShare"><img src="img/facebook-sharing.jpg" style="height:48px;"/></a>
        	<!--input type="button" id="FBShare" value="Share To Facebook"/-->
        </div>
    	<div style="float:left;padding-left:14%;">
        	<a type="button" id="TWShare"><img src="img/twitter_share.png" style="height:48px;"/></a>
			<!--input type="button" id="TWShare" value="Share To Twitter"/-->
		</div>
    </div>
</div>

</body>
</html>