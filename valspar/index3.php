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
require './facebook/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '492668300762232',
  'secret' => 'b637c96d95926c23f6d38835296951ac',
));

// Get User ID
$user = $facebook->getUser();
if($user)
{
	$access_token = $facebook->getAccessToken();
	
	echo $access_token;
	
	try {
//        $ret_obj = $facebook->api('/492668300762232/likes', 'POST',
//                                    array(
//                                      'access_token' => $access_token
//                                 ));
$attachment =  array(
'access_token' => $access_token,
'object' => 'https://apps.facebook.com/valspar'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://graph.facebook.com/me/likes');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output 
$result = curl_exec($ch);

var_dump( $result );
var_dump( $ch );

curl_close ($ch);

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_stream'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
		var_dump($e);
		echo $e->xdebug_message;
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
	echo ' Plz <a href="' . $login_url . '">login.</a>';	
}
/*
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
*/
?>
