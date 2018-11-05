<?php
include_once("include/session.php");
/**
 * Index.php
 *
 * This is an example of the main page of a website. Here
 * users will be able to login. However, like on most sites
 * the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether
 * the user has logged in or not.
 *
 */
?>


<html>
<head>
<title></title>
</head>


<body>

<?php 
/** User has already logged in, so display relavent links, including a link to the admin center if the user is an administrator. **/
if($session->logged_in){
  
  echo $session->username; // shows your username when logged in
  echo "<a href=\"profile.php?user=$session->username\">[View Profile]</a>"; // <a href="profile.php?user=$session->username">View Profile</a>
  echo "[<a href=\"settings.php\">Edit Account</a>]"; //<a href="settings.php">Settings</a>

  // $session->isAdmin() -- checks if user level is 9 and/or username is admin;
  if($session->isAdmin()){
    echo "[<a href=\"admin/\">Admin Center</a>]";// <a href="admin/">Admin Center</a>
  }
  echo "[<a href=\"process.php\">Logout</a>]"; // <a href="process.php">Logout</a>



/** Contents visible to everyone (even when not logged in) **/   
}else{ ?>

<p>This content is visible to everyone even when you're not logged in.</p>
<p>You can also put the log in form here.</p>

<?php
/*** User not logged in, display the login form.
**** If user has already tried to login, but errors were
**** found, display the total number of errors.
**** If errors occurred, they will be displayed.
***/


// Not Necessarily needed. ** Optional
if($form->num_errors > 0){
   echo $form->num_errors;
}
?>


<form action="process.php" method="POST">

  <input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>" placeholder="Username">
  <?php echo $form->error("user");?> <!-- Shows Errors for username -->

  <input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>" placeholder="password">
  <?php echo $form->error("pass");?> <!-- Shows Errors for password -->

  <input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>>Remember me next time

  <input type="hidden" name="sublogin" value="1">
  <input type="submit" value="Login">

  <a href="forgot-password.php">Forgot Password?</a> <!-- Forgot Password -->
  <a href="register.php">Register</a> <!-- Register -->

</form>

<?php } ?>

</body>
</html>