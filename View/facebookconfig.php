<?php
require 'Facebook/autoload.php';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// login facebook
define('APP_ID', '206360675552513');
define('APP_SECRET', 'cc58373f8ac10d7db0ad598ba0ffe345');
define('API_VERSION', 'v2.5');
define('FB_BASE_URL', 'https://furniture.vn');

define('BASE_URL', 'https://furniture.vn/index.php?action=login-account&get=facebook');

if(!session_id()){
    session_start();
}


// Call Facebook API
$fb = new Facebook([
 'app_id' => APP_ID,
 'app_secret' => APP_SECRET,
 'default_graph_version' => API_VERSION,
]);


// Get redirect login helper
$fb_helper = $fb->getRedirectLoginHelper();


// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token']))
		{$accessToken = $_SESSION['facebook_access_token'];}
	else
		{$accessToken = $fb_helper->getAccessToken();}
} catch(FacebookResponseException $e) {
     echo 'Facebook API Error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK Error: ' . $e->getMessage();
      exit;
}
