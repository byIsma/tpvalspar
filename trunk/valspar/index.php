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
	//$a = file_get_contents("submit.html");
	//echo ($a);
	header( 'Location: submit.html' ) ;
} else {
	// If a non-fan is on your page
	//$a = file_get_contents("submit.html");
	//echo ($a);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="CSS/index.css" />
        <script src="js/jquery-latest.js"></script>
        <script src="js/jquery.lightbox_me.js"></script>
        <script type="text/javascript">
	
			// Load the SDK Asynchronously
			(function(d)
			{
				var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement('script'); js.id = id; js.async = true;
				js.src = "//connect.facebook.net/en_US/all.js";
				ref.parentNode.insertBefore(js, ref);
			}(document));

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
			
			
			
				var ID = 0;
				var SubmitID = 0;
				var UserId = 0;
			$(document).ready(function(e)
			{
				var colorname;

				//grow();
				 
				
				$("#EMShare").click(function(e)
				{
//					var RTFBody = $('.item').attr("src");
//					window.open( "mailto:?subject=AAA&body=BBB&body=<img src=\""+$('.item').attr("src")+"\"/>");
					FB.api('/me', function(response)
					{
						window.open( "https://valspar.thetigerparty.com/Valspar/ShareByMail.php?ID="+ID+"&Name="+response.name+"&Email="+response.email, 
									"Share Mail",
									'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=150,height=150');
					});

				});

				$("#ImgBtFB").click(function(e)
				{
					var result = FB.ui(
					{
						method: 'feed',
						link: 'https://apps.facebook.com/valspar',
						picture: 'http://valspar.thetigerparty.com/Valspar/Assets/Facebook_Twitter_Icons/Color_'+ID+'_icon.png',
						name: 'Valspar Love Your Color Guarantee Project',
						caption: 'As a part of the Valspar Love Your Color Guarantee Project, I helped guarantee a donation to Habitat for Humanity by painting this house Valspar '+ colorname +'.',
						description: 'You can help, too!'
					},
					function(response)
					{
						if (response && response.post_id)
						{
							$('#PopupCanvas').trigger('close');
							//window.location.href = "thankyou.php";	
							$.post( 'https://valspar.thetigerparty.com/Valspar/SQL.php',	{"SubmitID": SubmitID}, function(data)
							{
							});
						}
						else
						{
						}
					});							

				});
				$("#ImgBtTW").click(function(e)
				{
					window.open( "https://valspar.thetigerparty.com/Valspar/twitter/index2.php?ID="+ID+"&SubmitID="+SubmitID, "Share Twitter",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=550,height=300');
					 
					$('#PopupCanvas').trigger('close');	
					//window.location.href = "thankyou.php";	
				});
		
				
				$("img[id^='ImgBt0']").mouseout(function(e)
				{
					$("#"+this.id).attr("src","Assets/01_Tab/Color_"+ this.id.substring(6) +".png");
				});
				$("img[id^='ImgBt0']").mouseover(function(e){
					$("#"+this.id).attr("src","Assets/01_Tab/Color_"+ this.id.substring(6) +"_OnMouseOver.png");
				});
				$("img[id^='ImgBt0']").click(function(e)
				{
					ID = this.id.substring(6);
					$("#ImgHouse").attr("src","Assets/01_Tab/House_"+ID+".png");
					$("#ImgBtSu").attr("src","Assets/01_Tab/Submit_Btn.png");
					$("#ImgBtSu").css("cursor","pointer");
					colorname = $(this).attr("data");
				});

				//$("#FBLike").mouseout(function(e){ $("#FBLike").attr("src","Assets/00_Fangate/LikeBtn.png"); });
				$("#loveyourcolor").mouseout(function(e){ $("#loveyourcolor").attr("src","Assets/00_Fangate/loveyourcolor_link.png"); });
				$("#ImgBtTx").mouseout(function(e){ $("#ImgBtTx").attr("src","Assets/01_Tab/LoveYourColor.png"); });
				$("#ImgBtFB").mouseout(function(e){ $("#ImgBtFB").attr("src","Assets/03_Post_Donate/Facebook_Share.png"); });
				$("#ImgBtTW").mouseout(function(e){ $("#ImgBtTW").attr("src","Assets/03_Post_Donate/Tweet.png"); });
				
				$("#FBLike").mouseover(function(e){ $("#FBLike").attr("src","Assets/00_Fangate/LikeBtn_OnMouseOver.png"); });
				$("#loveyourcolor").mouseover(function(e){ $("#loveyourcolor").attr("src","Assets/00_Fangate/loveyourcolor_link_OnMouseOver.png"); });
				$("#ImgBtTx").mouseover(function(e){ $("#ImgBtTx").attr("src","Assets/01_Tab/LoveYourColor_OnMouseOver.png"); });
				$("#ImgBtFB").mouseover(function(e){ $("#ImgBtFB").attr("src","Assets/03_Post_Donate/Facebook_Share_OnMouseOver.png"); });
				$("#ImgBtTW").mouseover(function(e){ $("#ImgBtTW").attr("src","Assets/03_Post_Donate/Tweet_OnMouseOver.png"); });

				$("#ImgBtSu").mouseup(function(e)
				{
					if(ID > 0)
						$("#ImgBtSu").attr("src","Assets/01_Tab/Submit_Btn.png");
				});
				$("#ImgBtSu").mousedown(function(e)
				{
					if(ID > 0)
						$("#ImgBtSu").attr("src","Assets/01_Tab/Submit_Btn_OnClick.png");
				});
				$("#ImgBtSu").click(function(e)
				{ 
					if(ID > 0)
					{
								FB.api('/me', function(response)
								{
									//$.post( 'https://valspar.thetigerparty.com/Valspar/SQLSubmit.php',	{"Name": response.name, "Email": response.email, "PictureSelect": ID}, function(data)
									//{
									//	SubmitID = data.split("\n")[2];
										 
									//	$('#PopupCanvas').lightbox_me({
									//		centered: true,
									//		onClose: function(){
									//			//window.location.href = "thankyou.php";
									//		}
									//	}); 
									//});
								 
									$.post( 'https://valspar.thetigerparty.com/Valspar/SQLSubmit.php',	{"PictureSelect": ID}, function(data)
									{
										SubmitID = data.split("\n")[2];
										 
										$('#PopupCanvas').lightbox_me({
											centered: true,
											onClose: function(){
												//window.location.href = "thankyou.php";
											}
										}); 
									});
								});
						
						
					}
				});
				
				$("#ImgBtClose").mouseup(function(e){ $("#ImgBtClose").attr("src","Assets/03_Post_Donate/Close.png"); });
				$("#ImgBtClose").mousedown(function(e){ $("#ImgBtClose").attr("src","Assets/03_Post_Donate/Close_OnClick.png"); });
				$("#ImgBtClose").click(function(e){ 
					$('#PopupCanvas').trigger('close'); 
					
				});
				
				 
			});
			
			function GotoSubmitPage()// onclick="GotoSubmitPage()"
			{
				$("#IndexPage").hide();
				$("#SubmitPage").show();
			}

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
			
			var iframe = $('.fb-like')[0].childNodes[0].childNodes[0];
			alert( "Frame title: " + iframe.contentWindow.title );
  
        </script>
<title>Valspar</title>
</head>

<body style="width:100%;height:1160px;overflow:hidden;margin:0; padding:0; border:0;" onLoad="grow();">

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
 
<div id="SubmitPage">
	<div id="MainCanvas">
		<div class="objinside" id="DivImgHouse"><img src="" id="ImgHouse" /></div>

		<div class="objinside" id="DivImgColor1"><img src="Assets/01_Tab/Color_1.png" id="ImgBt01" data="COOL RAIN"/></div>
		<div class="objinside" id="DivImgColor2"><img src="Assets/01_Tab/Color_2.png" id="ImgBt02" data="MARTIAN"/></div>
		<div class="objinside" id="DivImgColor3"><img src="Assets/01_Tab/Color_3.png" id="ImgBt03" data="POOL PARTY"/></div>
		<div class="objinside" id="DivImgColor4"><img src="Assets/01_Tab/Color_4.png" id="ImgBt04" data="SONIC PLUM"/></div>
		<div class="objinside" id="DivImgColor5"><img src="Assets/01_Tab/Color_5.png" id="ImgBt05" data="RASPBERRY SORBET"/></div>
        
		<div class="objinside" id="DivImgBtSubmit"><img src="Assets/01_Tab/Submit_Btn_Disabled.png" id="ImgBtSu" /></div>
		<div class="objinside" id="DivImgBtText">
			<a target="_blank" href="http://www.loveyourcolor.com/">
				<img src="Assets/01_Tab/LoveYourColor.png" id="ImgBtTx" style="border:0 none;" />
			</a>
		</div>
	</div>
    <div class="objinside" id="PopupCanvas">
		<!--div style="position:absolute; left:64px; top:472px"><img src="Assets/03_Post_Donate/Post_Donate_BG.png" id="FBLike" /></div-->
		<div class="objinside" id="DivImgBtFB"><img src="Assets/03_Post_Donate/Facebook_Share.png" id="ImgBtFB" /></div>
		<div class="objinside" id="DivImgBtTW"><img src="Assets/03_Post_Donate/Tweet.png" id="ImgBtTW" /></div>
		<div class="objinside" id="DivImgBtClose"><img src="Assets/03_Post_Donate/Close.png" id="ImgBtClose" /></div>
    </div>
</div>

</body>
</html>