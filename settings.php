<?php
include_once("include/session.php");
/**
 * UserEdit.php
 *
 * This page is for users to edit their account information
 * such as their password, email address, etc. Their
 * usernames can not be edited. When changing their
 * password, they must first confirm their current password.
 *
 */
?>

<html>
<title></title>
<body>


<?php
/** User has submitted form without errors and user's account has been edited successfully. */
if(isset($_SESSION['useredit'])) {

   unset($_SESSION['useredit']);
   echo "<p><strong>$session->username</strong>, your account has been successfully updated. ";

}else{

	/*  If user is logged in, then display the form to edit account information, with the current email address already in the field. */
	if($session->logged_in){ ?>
		<h1><?php echo $session->username; ?>'s Settings</h1>


		<?php
		// Show number of errors from the form. * Optional
		if($form->num_errors > 0){
		   echo $form->num_errors." error(s) found";
		} ?>



		<form action="process.php" method="POST">	
			<input type="password" name="curpass" maxlength="30" value="<?php echo $form->value("curpass"); ?>" placeholder="Current Password">
			<?php echo $form->error("curpass"); ?><!-- Show Error from current password -->

			<input type="password" name="newpass" maxlength="30" value="<?php echo $form->value("newpass"); ?>" placeholder="New Password">
			<?php echo $form->error("newpass"); ?><!-- Show Error from new password -->

			<input type="text" name="email" maxlength="50" value="<?php if($form->value("email") == ""){ echo $session->userinfo['email']; }else{ echo $form->value("email");} ?>">
			<?php echo $form->error("email"); ?><!-- Show Error from Email -->

			<input type="hidden" name="subedit" value="1">
			<input type="submit" value="Edit Account"></td></tr>
		</form>

<?php
	}

	/*If user is not logged in and trying to access the settings page*/
	echo "Please <a href=\"login.php\">Log in</a>"; // or you can also redirect them to your log in page
}
?>

</body>
</html>
