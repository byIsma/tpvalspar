<?php

require './twitter/tmhOAuth.php';
require './twitter/tmhUtilities.php';

$tmhOAuth = new tmhOAuth(array(
  'consumer_key'    => 'rf0ohTLUkQ5qUftVpa1jSg',
  'consumer_secret' => 'Y6QBh5fZPPyBklQC7Xf6CJeUjP7oWhENlg6XxxkPMtI',
  'user_token'      => '744201864-VwqcqD68yvVyuknYb9BlxLMCv4h87Q45LnJNLjIG',
  'user_secret'     => '1vP22OM6Fbj5brrdKQ4olvLDezhZJyuc4HRIqAN8',
));

// we're using a hardcoded image path here. You can easily replace this with an uploaded image-see images.php example)
// 'image = "@{$_FILES['image']['tmp_name']};type={$_FILES['image']['type']};filename={$_FILES['image']['name']}",
 
$image = "./img/sample001.jpg";
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
  false  // multipart
);



//*/
//foreach( explode( "\n",$tmhOAuth->response['info']['request_header']) as $str)
//	var_dump (  explode( "," , $str));
var_dump ( explode( ",",$tmhOAuth->response['info']['request_header']));
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