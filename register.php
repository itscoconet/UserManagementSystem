<?php
include_once("include/session.php");
/**
 * Register.php
 * 
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 *
 */

?>

<html>
<title></title>
<body>

<?php
/**  The user is already logged in, not allowed to register. */
if($session->logged_in){
  echo $session->username . ", you're already registered.";
}

/** The user has submitted the registration form and the  results have been processed. */
else if(isset($_SESSION['regsuccess'])){

  /* Registration was successful */
  if($_SESSION['regsuccess']){
      echo $_SESSION['reguname'] . " has been registered.";
      echo "<a href=\"login.php\">Login</a>"; // add link to login page
  }

   /* Registration failed */
  else{
      echo "Failed to register " . $_SESSION['reguname'];
  }

  unset($_SESSION['regsuccess']);
  unset($_SESSION['reguname']);
}





/* The user has not filled out the registration form yet. Below is the page with the sign-up form, the names  of the input fields are important and should not be changed. */
else{ ?>



<h1> Register</h1>

<?php
// ** Optional - Show number of errors from the register form
if($form->num_errors > 0){ 
  echo $form->num_errors." error(s) found"; 
} ?>


<form action="process.php" method="POST">
  <input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>" placeholder="Username">
  <?php echo $form->error("user"); ?> <!-- Shows error for username -->

  <input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>" placeholder="Password">
  <?php echo $form->error("pass"); ?> <!-- Shows error for password-->

  <input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>" placeholder="Email Address">
  <?php echo $form->error("email"); ?> <!-- Shows error for email -->


  <input type="hidden" name="subjoin" value="1">
  <input type="submit" value="Register!"></td></tr>
</form>

<?php } ?>

</body>
</html>
