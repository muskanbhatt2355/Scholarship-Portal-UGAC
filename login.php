<?php
session_start();
require_once 'sso_handler.php';


$CLIENT_ID='WG87dYQoNqiuiGhcndONV13I4N5ZtLMKlxPVD2Bx';
$CLIENT_SECRET='wDOyadYv2gcN6nhf7AZWR88nvzj6mxP2IBTECFpblGJuYvaiGoqTfuMHc83eim1Z9ylqp115wWw5FlJt8blhkoH8IperYVgPvcNPO58xN0vUvK8vTiTQTwv0HuFdXZuO';
echo "hi";
//$required_fields = array('username', 'email', 'roll_number');
//$state = 'user_login';
$response_type = 'code';
$permissions = 'basic profile ldap';
$REDIRECT_URI = 'http://localhost/UGAC_SCP/login.php';
$sso_handler = new SSOHandler($CLIENT_ID, $CLIENT_SECRET);
$required_scopes=array('basic','profile','ldap');
$required_fields = array('username', 'email', 'roll_number', 'first_name','last_name');

if ($sso_handler->validate_code($_GET) && $sso_handler->validate_state($_GET)) {
echo "hello";
  $response = $sso_handler->default_execution($_GET, $REDIRECT_URI,$required_scopes,$required_fields);
}
 
 if (!isset($response['error']) && isset($response['access_information']) && isset($response['user_information'])) {
    echo "hello";
	//echo $response['user_information'][0];
echo '<pre>'; print_r($response['access_information']); echo '</pre>';
echo '<pre>'; print_r($response['user_information']); echo '</pre>';

$access_token=$response['access_information']['access_token'];
echo $access_token;

	$admin_username = $response['user_information']['username'];

	$servername = "localhost";
	$username = "root";
	$password = "";

	$con = mysqli_connect($servername, $username, $password,'scholarship_portal1');

	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}

	$sql = "SELECT * FROM admin WHERE admin_username = $admin_username";
 	$result = mysqli_query($con,$sql);

    if(mysqli_fetch_array($result) !== false){
        header('Location:add_scholarship.php');
    }
    else{
    	mysqli_close($con);
    	session_destroy();
    	header('Location:index_bts.php');

    }

    
}
?>
