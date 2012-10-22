<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */
if( !isset( $_GET['ID'] ))
{
	echo "POST Failed";
	exit;
}
/* Load required lib files. */
session_start();
require_once('twitteroauth/tmhOAuth.php');
require_once('twitteroauth/tmhUtilities.php');

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php?ID='.$_GET['ID'].'SubmitID='.$_GET['SubmitID']);
     
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
//$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$connection = new tmhOAuth(array(
		'consumer_key'    => 'rf0ohTLUkQ5qUftVpa1jSg',
		'consumer_secret' => 'Y6QBh5fZPPyBklQC7Xf6CJeUjP7oWhENlg6XxxkPMtI',
		'user_token'	  => $access_token['oauth_token'], 
		'user_secret'     => $access_token['oauth_token_secret']));
 
/* If method is set change API call made. Test is called by default. */
//$content = $connection->get('account/verify_credentials');

/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* statuses/update */
//$image = "./button001.jpg";
$image = "c:\\wamp\\www\\Valspar\\Assets\\01_Tab\\House_".$_GET['ID'].".png";
//$filepath = "button001.jpg"; $filetype = "image/jpeg"; $fileName = "button0001.jpg";
//$image = "{$filepath};type={$filetype};filename={$fileName}";
date_default_timezone_set('GMT');
//$parameters = array('status' => "Why I can't share", 'media[]' => "@$image;type=image/jpeg;filename=$image" );
//$parameters = array('status' => "Why I can't share", 'media[]' => "@{$image};type=image/jpeg;filename={$image}" );
//$status = $connection->post('statuses/update_with_media', $parameters);

//$code = $tmhOAuth->request('POST', 'https://api.twitter.com/1.1/statuses/update_with_media.json',

$code = $connection->request('POST', 'https://upload.twitter.com/1/statuses/update_with_media.json',
	array(
    	'media[]'  => "@{$image};type=image/png;filename={$image}",
    	'status'   => $_GET['String']//"Valspar Love Your Color Guarabtee Project. https://apps.facebook.com/valspar/" // Don't give up..
  	),
  	true, // use auth
  	true  // multipart
);
if ($code == 200)
{
	/* Create a TwitterOauth object with consumer/user tokens. */
	$Getter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	/* If method is set change API call made. Test is called by default. */
	$content = $Getter->get('account/verify_credentials');

	$_SESSION['SubmitID'] = $_GET['SubmitID'];

$_SESSION['PictureSelect'] = $_GET['ID'];
	require( "../SQL.php");
//	var_dump($content->id_str);
//	var_dump($content->name);

//  tmhUtilities::pr(json_decode($connection->response['response']));
//	header( 'Location: '.json_decode($connection->response['response'])->entities->media[0]->expanded_url );
echo json_decode($connection->response['response'])->entities->media[0]->expanded_url;
//	var_dump( json_decode($connection->response['response'])->entities );
}
else
{
var_dump( $connection );
  tmhUtilities::pr($connection->response['response']);
}

