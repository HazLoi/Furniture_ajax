<?php
require 'vendor/autoload.php';
require 'Facebook/autoload.php';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

$conn = new connect();
$user = new user();

$client = new Google_Client();
$client->setClientId('458994670626-3k047acrc0fs14lp12oq6b693753n8sv.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://furniture.vn/index.php?action=login-account&get=google');

// create Client Request to access Google API
$client->addScope("email");
$client->addScope("profile");

// login facebook
define('APP_ID', '678993617322027');
define('APP_SECRET', 'bd8f068061eade465bf5063b6b2daa6a');
define('API_VERSION', 'v17.0');
define('FB_BASE_URL', 'https://furniture.vn');

define('BASE_URL', 'https://furniture.vn/index.php?action=login-account');

if (!session_id()) {
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
// $loginUrl = $fb_helper->getLoginUrl('https://furniture.vn/index.php?action=login-account&get=facebook', $permissions);

// Try to get access token

if (isset($_GET['get']) && $_GET['get'] == 'facebook') {
	try {
		if (isset($_SESSION['facebook_access_token'])) {
			$accessToken = $_SESSION['facebook_access_token'];
		} else {
			$accessToken = $fb_helper->getAccessToken();
		}
	} catch (FacebookResponseException $e) {
		echo 'Facebook API Error: ' . $e->getMessage();
		exit;
	} catch (FacebookSDKException $e) {
		echo 'Facebook SDK Error: ' . $e->getMessage();
		exit;
	}
}

$permissions = ['public_profile'];

// if (isset($_GET['get']) && $_GET['get'] == 'facebook' && isset($_GET['code'])) {
if (isset($accessToken)) {
	if (!isset($_SESSION['facebook_access_token'])) {
		//get short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

		//OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		//Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		//setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	//redirect the user to the index page if it has $_GET['code']
	if (isset($_GET['code'])) {
		// echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
	}
	try {
		$fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
		$fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');

		$fb_user = $fb_response->getGraphUser();
		$picture = $fb_response_picture->getGraphUser();

		// $_SESSION['fb_user_id'] = $fb_user->getProperty('id');
		// $_SESSION['fb_user_name'] = $fb_user->getProperty('name');
		// $_SESSION['fb_user_email'] = $fb_user->getProperty('email');
		// $_SESSION['fb_user_pic'] = $picture['url'];
		// echo "<pre>";
		// var_dump($picture);
		// echo "</pre>";
		// die;
		if (!empty($fb_user)) {
			$email = $fb_user['email'];
			$first_name = $fb_user['first_name'];
			$last_name = $fb_user['last_name'];
			$full_name = $fb_user['name'];
			$picture =  $picture['url'];
			$id = $fb_user['id'];

			$select = "SELECT * FROM nguoi_dung WHERE id_fb = $id";
			$result = $conn->getInstance($select);
			if ($result) {
				if ($result['trangthai'] == 1) {
					$_SESSION['id'] = $result['id'];
					$_SESSION['fullname'] = $result['hovaten'];
					$_SESSION['lname'] = $result['ten'];
					$_SESSION['fname'] = $result['ho'];
					$_SESSION['image'] = $result['anh'];
					$_SESSION['id_fb'] =  $result['id_fb'];
					if(isset($result['email'])){
						$_SESSION['email'] = $result['email'];						
					}else{
						$_SESSION['email'] = '';
					}
					if(isset($result['sdt'])){
						$_SESSION['phone'] = $result['sdt'];
					}else{
						$_SESSION['phone'] = '';
					}
					if(isset($result['gender'])){
						$_SESSION['gender'] = $result['gender'];
					}else{
						$_SESSION['gender'] = '';
					}
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
				} else {
					echo "<script>alert('Tài khoản đã bị khóa !')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
				}
			} else {
				$existsEmailGG =  $user->existsEmailAccount($email);
				if ($existsEmailGG) {
					echo "<script>alert('Email đã tồn tại')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
				} else {
					$insert = "INSERT INTO nguoi_dung (ho, ten ,hovaten, email, trangthai, anh, id_fb) VALUES
					('$first_name', '$last_name', '$full_name', '$email', 1, '', '$id')";

					$conn->exec($insert);

					$checkUser = $user->getInfoFBByCustomerId($id);
					if ($checkUser) {
						$_SESSION['id'] = $checkUser['id'];
						$_SESSION['fullname'] = $checkUser['hovaten'];
						$_SESSION['lname'] = $checkUser['ten'];
						$_SESSION['fname'] = $checkUser['ho'];
						$_SESSION['image'] = $checkUser['anh'];
						$_SESSION['id_fb'] =  $checkUser['id_fb'];
						if(isset($checkUser['email'])){
							$_SESSION['email'] = $checkUser['email'];						
						}else{
							$_SESSION['email'] = '';
						}
						if(isset($checkUser['sdt'])){
							$_SESSION['phone'] = $checkUser['sdt'];
						}else{
							$_SESSION['phone'] = '';
						}
						if(isset($checkUser['gender'])){
							$_SESSION['gender'] = $checkUser['gender'];
						}else{
							$_SESSION['gender'] = '';
						}
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
					} else {
						echo "<script>alert('Tài khoản đã bị khóa !!')</script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
					}
				}
			}
		}
	} catch (FacebookResponseException $e) {
		echo 'Facebook API Error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
		exit;
	} catch (FacebookSDKException $e) {
		echo 'Facebook SDK Error: ' . $e->getMessage();
		exit;
	}
}
// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
$fb_login_url = $fb_helper->getLoginUrl('https://furniture.vn/index.php?action=login-account&get=facebook', $permissions);

// }
?>

<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/2.jpg)">
	<div class="auto-container">
		<h2>Đăng nhập</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Đăng nhập</li>
		</ul>
	</div>
</section>

<!--End Page Title-->
<section>
	<div class="auto-container my-5" style="font-size: 16px">
		<h1 class="text-center title-page">Đăng nhập tài khoản</h1>
		<form class="col-lg-6 col-md-6 col-sm-12 m-auto" id="formLogin" method="post">

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="text" name="email" autocomplete="off" spellcheck="false" placeholder="Nhập email của bạn" value="otakushi01@gmail.com">
			</div>

			<div class="form-group">
				<label for="passwordAccount">Mật khẩu</label>
				<input class="form-control" type="password" name="password" id="password" autocomplete="off" spellcheck="false" placeholder="Mật khẩu" value="123456">
				<div class="d-flex  justify-content-between">
					<button class="border-0" style="background: none;" type="button" onclick="showPass()">
						<span id="showPass">Hiện mật khẩu</span>
					</button>
					<a href="index.php?action=reset-password" class="text-primary">Quên mật khẩu ?</a>
				</div>
			</div>

			<div class="form-group d-flex justify-content-between">
				<?php $authUrl = $client->createAuthUrl(); ?>
				<a href="<?= $authUrl ?>" class="btn btn-danger btn-user">
					<i class="fab fa-google fa-fw"></i> Đăng nhập với Google
				</a>
				<a href="<?php
							echo $fb_login_url;
							?>" class="btn btn-primary btn-user">
					<i class="fab fa-facebook-f fa-fw"></i> Đăng nhập với Facebook
				</a>
			</div>

			<div class="d-flex justify-content-between">
				<div>
					<button class="btn btn-info">
						Đăng nhập
					</button>
				</div>
				<div>
					<a href="index.php?action=register-account" class="btn btn-primary">Chưa có tài khoản</a>
				</div>
			</div>

		</form>
	</div>
</section>

<?php
// authenticate code from Google OAuth Flow

if (isset($_GET['get']) && $_GET['get'] == 'google' && isset($_GET['code'])) {
	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	$client->setAccessToken($token['access_token']);
	// get profile info
	$google_oauth = new Google_Service_Oauth2($client);
	$google_account_info = $google_oauth->userinfo->get();

	$userinfo = [
		'email' => $google_account_info['email'],
		'first_name' => $google_account_info['givenName'],
		'last_name' => $google_account_info['familyName'],
		'gender' => $google_account_info['gender'],
		'full_name' => $google_account_info['name'],
		'picture' => $google_account_info['picture'],
		'verifiedEmail' => $google_account_info['verifiedEmail'],
		'token' => $google_account_info['id'],
	];

	// checking if user is already exists in database
	$sql = "SELECT * FROM nguoi_dung WHERE token = '{$userinfo['token']}'";
	$result = $conn->getInstance($sql);

	if ($result) {
		if ($result['trangthai'] == 1) {
			$_SESSION['id'] = $result['id'];
			$_SESSION['fullname'] = $result['hovaten'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['lname'] = $result['ten'];
			$_SESSION['fname'] = $result['ho'];
			$_SESSION['phone'] = $result['sdt'];
			$_SESSION['image'] = $result['anh'];
			$_SESSION['gender'] = $result['gioitinh'];
			$_SESSION['token'] =  $result['token'];
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
		} else {
			echo "<script>alert('Tài khoản đã bị khóa')</script>";
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
		}
	} else {
		$email = $userinfo['email'];
		$first_name = $userinfo['first_name'];
		$last_name = $userinfo['last_name'];
		$gender = $userinfo['gender'];
		$full_name = $userinfo['full_name'];
		$picture = $userinfo['picture'];
		$token = $userinfo['token'];
		$verifiedEmail = $userinfo['verifiedEmail'];

		$existsEmailGG =  $user->existsEmailAccount($email);
		if ($existsEmailGG) {
			echo "<script>alert('Email đã tồn tại')</script>";
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
		} else {
			$insert = "INSERT INTO nguoi_dung (ho, ten ,hovaten, gioitinh, email, anh, xacthuc, token) VALUES
			('$first_name', '$last_name', '$full_name', '$gender', '$email', '$picture', '$verifiedEmail', '$token')";

			$conn->exec($insert);

			$checkUser = $user->getInfoGGByCustomerId($token);
			if ($checkUser) {
				$_SESSION['id'] = $checkUser['id'];
				$_SESSION['fullname'] = $checkUser['hovaten'];
				$_SESSION['email'] = $checkUser['email'];
				$_SESSION['lname'] = $checkUser['ten'];
				$_SESSION['fname'] = $checkUser['ho'];
				$_SESSION['phone'] = $checkUser['sdt'];
				$_SESSION['image'] = $checkUser['anh'];
				$_SESSION['gender'] = $checkUser['gioitinh'];
				$_SESSION['token'] =  $checkUser['token'];
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
			}
		}
	}
}

// if (isset($_GET['get']) && $_GET['get'] == 'facebook' && isset($_GET['code'])) {
// 	if (isset($accessToken)) {
// 		if (!isset($_SESSION['facebook_access_token'])) {
// 			//get short-lived access token
// 			$_SESSION['facebook_access_token'] = (string) $accessToken;

// 			//OAuth 2.0 client handler
// 			$oAuth2Client = $fb->getOAuth2Client();

// 			//Exchanges a short-lived access token for a long-lived one
// 			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
// 			$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

// 			//setting default access token to be used in script
// 			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
// 		} else {
// 			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
// 		}


// 		//redirect the user to the index page if it has $_GET['code']
// 		if (isset($_GET['code'])) {
// 			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
// 		}


// 		try {
// 			$fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
// 			$fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');

// 			$fb_user = $fb_response->getGraphUser();
// 			$picture = $fb_response_picture->getGraphUser();

// 			$_SESSION['fb_user_id'] = $fb_user->getProperty('id');
// 			$_SESSION['fb_user_name'] = $fb_user->getProperty('name');
// 			$_SESSION['fb_user_email'] = $fb_user->getProperty('email');
// 			$_SESSION['fb_user_pic'] = $picture['url'];
// 		} catch (FacebookResponseException $e) {
// 			echo 'Facebook API Error: ' . $e->getMessage();
// 			session_destroy();
// 			// redirecting user back to app login page
// 			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
// 			exit;
// 		} catch (FacebookSDKException $e) {
// 			echo 'Facebook SDK Error: ' . $e->getMessage();
// 			exit;
// 		}
// 	} else {
// 		// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
// 		$fb_login_url = $fb_helper->getLoginUrl('https://furniture.vn/index.php?action=login-account&get=facebook', $permissions);
// 	}
// }
?>