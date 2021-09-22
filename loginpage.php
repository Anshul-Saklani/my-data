	
<!DOCTYPE html>
<html>
<head>
<title>Title of document</title>
<body>
<form method= "post" name = "login">

Email : <input type = "text" name = "email" id = "email"/><br/><br/>
Password : <input type = "password" name = "password" id = "password"/><br/><br/>
<input type = "submit"  name = "login" value = "Login"/>

</form>
<?php
error_reporting(E_ALL);
session_start();
function db_connection(){
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "Anshul";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  return $conn;
}
if (isset($_POST["login"])){
	$conn = db_connection();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "select * from application where email = '$email' and password = '$password'";
	//echo $sql; die;
	$result =  mysqli_query($conn,$sql);
	 $records = mysqli_fetch_array($result, MYSQLI_ASSOC);
	 if(isset($records)){
		$_SESSION['email'] = $records["email"];
	    $_SESSION['password'] = $records["password"];
		header("location: /test/homepage.php");
		
		
	 }
}





/*require_once 'vendor/autoload.php';




$fb = new Facebook\Facebook([
  'app_id' => '1467577490288442',
  'app_secret' => '0b2fea92d9545cfee038e23a8a8c755d',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/test/loginpage.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';


try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exception\ResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exception\SDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
$accesstoken = $accessToken->getValue();

$graph_response = $fb->get("/me?fields=name,email", $accesstoken);

 $facebook_user_info = $graph_response->getGraphUser();
print_r($facebook_user_info["name"]); die;*/






 require_once 'vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId('488455610206-m6u9ollaln1srdouq4io3caol9784rmh.apps.googleusercontent.com');

$google_client->setClientSecret('VyBMJ8Wz6riMxLaMjr5BVrRA');
$google_client->setRedirectUri('http://localhost/test/loginpage.php');





$google_client->addScope('email');

$google_client->addScope('profile');



$login_button = '';

if(isset($_GET["code"]))
{
	//echo "<pre>"; print_r($google_client); die;

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
  if(!isset($token['error'])){
	 $google_client->setAccessToken($token['access_token']);
	  
	 $_SESSION['access_token'] = $token['access_token'];
 $google_service = new Google_Service_Oauth2($google_client);
  $data = $google_service->userinfo->get();
   if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name']; 
  }
   if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }
  }
}

	  
if(!isset($_SESSION['access_token']))
{
	 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png" /></a>';
}

	   if($login_button == '')
   {
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
  
  
  
?>




