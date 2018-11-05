<?php
include_once("include/session.php"); // Session.PHP
/*** LOGIN.PHP
* This is an example of the log in page of a website. Here users will be able to login. However, like on most sites the login form doesn't just have to be on the main page, but re-appear on subsequent pages, depending on whether the user has logged in or not.
***/
?>

<html>
<title></title>
<body>


<?php
/* User has already logged in, redirect to a page */
if($session->logged_in){
   header("Location: profile.php?user=$session->username"); // Redirect to profile or anywhere you like
} else{ ?>

<?php
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */



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
