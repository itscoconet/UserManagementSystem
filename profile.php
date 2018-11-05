<?php
include_once("include/session.php");
/**
 * UserInfo.php
 *
 * This page is for users to view their account information
 * with a link added for them to edit the information.
 *
 */
?>

<html>
<title></title>
<body>

<?php
/* Requested Username error checking */
$req_user = trim($_GET['user']);
if(!$req_user || strlen($req_user) == 0 ||
   !preg_match("/^([0-9a-z])+$/", $req_user) ||
   !$database->usernameTaken($req_user)){
   		// If username is not registered, show error message.
		// You may also redirect to an error page ** optional
		die("Username not registered");
}

/* Display requested user information */
$user_info = $database->getUserInfo($req_user);

/** when you add your own fields to the users table to hold more information, like age, location, etc. 
they can be easily accessed by the user info array...


*** FOR LOGGED IN USERS: 
	** use $session->userinfo[''];
	Examples: 
 	* $session->userinfo['location']; 
 	* $session->userinfo['aga']; 
 
*** FOR VIEWING OTHER USER'S ACCOUNT/OR ANY USERS:
*** THIS ALSO WORKS FOR LOGGED IN USERS WHO ARE VIEWING THEIR OWN ACCOUNT
	** use $user_info[''];
	Examples: 
	* $user_info['location'];
	* $user_info['age']

***/



/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0){
	echo "<h3>".$session->username."</h3>"; // or you can use $session->userinfo['username'];
   	echo "<p>Viewing your own account</p>";
	echo "<a href=\"settings.php\">Settings</a>"; // If user is viewing own account, show settings page.
}
/* Visitor not viewing own account// Logged in user viewing other user's account */
else{
	echo "<h1>Viewing". $user_info['username']."'s account</h1>";
	echo "Email: ".$user_info['email'];
}


if($session->isAdmin()){
   echo "[<a href=\"admin/\">Admin Center</a>]";// <a href="admin/">Admin Center</a>
}?>

<a href="process.php">Log Out</a>

</body>
</html>
