<?php
/*
$to = "kaku32@hotmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "kaku32@hotmail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
*/
//header( 'Location: index.html' ) ;

require './facebook/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '492668300762232',
  'secret' => 'b637c96d95926c23f6d38835296951ac',
  'cookie' => true
));

$signed_request = $facebook->getSignedRequest();

$page_id = $signed_request["page"]["id"];
$page_admin = $signed_request["page"]["admin"];
$like_status = $signed_request["page"]["liked"];
$country = $signed_request["user"]["country"];
$locale = $signed_request["user"]["locale"];
 
if ($like_status) { 
	header( 'Location: submit.html' ) ;
}  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="CSS/index.css" />
        <script src="js/jquery-latest.js"></script> 
         <script>
			function grow()
			{
			    FB.Canvas.setAutoGrow(); 
			    
			    FB.getLoginStatus(function(response) {
			        var status = response.status;
					if (status == 'connected') { 
					} else if(status == 'notConnected') {
					 
					} else {
				              
			        }
				});
			}
			
//			var iframe = $('.fb-like')[0].childNodes[0].childNodes[0];
//			alert( "Frame title: " + iframe.contentWindow.title );onLoad="grow();
  
        </script>
<title>Valspar</title>
</head>

<body style="width:100%;height:1160px;overflow:hidden;margin:0; padding:0; border:0;" ">

<div id="IndexPage" style="height:100%">
	<div id="FongateCanvas">
    	<img src="Assets/00_Fangate/00Fangate_BG.png"  /><!--style="cursor:pointer;"-->
		<span class="objinside" id="ImgLink">
        	<a href="http://www.loveyourcolor.com/">
            	<img src="Assets/00_Fangate/loveyourcolor_link.png" id="loveyourcolor" style="border:0 none;"/>
            </a>
        </span>
        <div class="objinside" id="ImgLike">
        	<img src="Assets/00_Fangate/LikeBtn.png" id="FBLike" style="border:0 none;"/>
        	<!--a href="http://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fapps.facebook.com%2Fvalspar&send=false&layout=button_count&width=113&show_faces=false&action=like&colorscheme=light&font=arial&height=21&appId=492668300762232">
        		
            </a-->
       	  <!--div class="fb-like" data-href="https://apps.facebook.com/valspar" data-send="false" data-layout="button_count" data-width="113" data-show-faces="false" data-font="arial"></div-->
    	</div>
		<div class="objinside" id="ImgLink"></div>
    </div>
</div>
  
</div>

</body>
</html>