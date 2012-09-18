<?php

session_start();

require './twitter/tmhOAuth.php';
require './twitter/tmhUtilities.php';

if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) 
{
//    header('Location: ./clearsessions.php');
/* Build TwitterOAuth object with client credentials. */
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	
	/* Get temporary credentials. */
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

	/* Save temporary credentials to session. */
	$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
	/* If last connection failed don't display authorization link. */
	switch ($connection->http_code) {
	  case 200:
	    /* Build authorize URL and redirect user to Twitter. */
	    $url = $connection->getAuthorizeURL($token);
	    header('Location: ' . $url); 
	    break;
	  default:
	    /* Show notification if something went wrong. */
	    echo 'Could not connect to Twitter. Refresh the page or try again later.';
	}

}
else
{
	$tmhOAuth = new tmhOAuth(array(
		'consumer_key'    => 'rf0ohTLUkQ5qUftVpa1jSg',
		'consumer_secret' => 'Y6QBh5fZPPyBklQC7Xf6CJeUjP7oWhENlg6XxxkPMtI',
		'user_token'      => $_SESSION['access_token']['oauth_token'],
		'user_secret'     => $_SESSION['access_token']['oauth_token_secret'],
));
	
}

// we're using a hardcoded image path here. You can easily replace this with an uploaded image-see images.php example)
// 'image = "@{$_FILES['image']['tmp_name']};type={$_FILES['image']['type']};filename={$_FILES['image']['name']}",
 
$image = "c:\\wamp\\www\\Valspar\\img\\sample001.jpg";
//$image = "http://www.bespoke-app.com/media_storage/flower.jpg";

//$filepath = "./img/button001.jpg"; $filetype = "image/jpeg"; $fileName = "button0001.jpg";
//$image = "{$filepath};type={$filetype};filename={$fileName}";

/* 
$code = $tmhOAuth->request('POST', 'https://upload.twitter.com/1/statuses/update_with_media.json',
  array(
    'media[]'  => "{$image}",
    'status'   => "testing" // Don't give up..
  ),
  true, // use auth
  true  // multipart
);
/*/
$code = $tmhOAuth->request('POST', 'https://upload.twitter.com/1/statuses/update_with_media.json',
//$code = $tmhOAuth->request('POST', 'https://api.twitter.com/1.1/statuses/update_with_media.json',
  array(
    'media[]'  => "@{$image};type=image/jpeg;filename={$image}",
    'status'   => "testing" // Don't give up..
  ),
  true, // use auth
  true  // multipart
);



//*/
//foreach( explode( "\n",$tmhOAuth->response['info']['request_header']) as $str)
//	var_dump (  explode( "," , $str));
//var_dump ( explode( ",",$tmhOAuth->response['info']['request_header']));
var_dump ($tmhOAuth->config);

if ($code == 200)
{
  tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
}
else
{
  tmhUtilities::pr($tmhOAuth->response['response']);
}
var_dump ($tmhOAuth);

?>