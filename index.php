<?php
include_once("functions.php");
/**
 * Admin.php
 *
 * This is the Admin Center page. Only administrators
 * are allowed to view this page. This page displays the
 * database table of users and banned users. Admins can
 * choose to delete specific users, delete inactive users,
 * ban users, update user levels, etc.
 *
 */




   
/**
 * User not an administrator, redirect to login page
 * automatically.
 */
if(!$session->isAdmin()){
   header("Location: ../login.php");
}
else{
/**
 * Administrator is viewing page, so display all
 * forms.
 */
?>
<html>
<head>
  <title></title>
</head>
<body>

<h1>Admin Center - <?php echo $session->username; ?></h1>
<p>This is the place to administrate the login system</p>

 
<!--/* Display Users Table */-->
<h3>Users Table Contents:</h3>
<?php displayUsers(); ?>


<!--/* Update User Level */-->
<h3>Update User Level</h3>
<?php echo $form->error("upduser"); ?>

<form action="adminprocess.php" method="POST">
  <input type="text" name="upduser" maxlength="30" value="<?php echo $form->value("upduser"); ?>" placeholder="Username">
  <select name="updlevel">
    <option>Select User Level</option>
    <option value="1">User
    <option value="9">Admin
  </select>
  <input type="hidden" name="subupdlevel" value="1">
  <input type="submit" value="Update Level">
</form>



<!--/* Delete User*/-->
<h3>Delete User</h3>
<?php echo $form->error("deluser"); ?>
<form action="adminprocess.php" method="POST">
  <input type="text" name="deluser" maxlength="30" value="<?php echo $form->value("deluser"); ?>" placeholder="Username">
  <input type="hidden" name="subdeluser" value="1">
  <input type="submit" value="Delete User">
</form>



<!--/* Delete Inactive User */-->
<h3>Delete Inactive Users</h3>
<p>This will delete all users (not administrators), who have not logged in to the site
within a certain time period. You specify the days spent inactive.</p>

<form action="adminprocess.php" method="POST">
  <select name="inactdays">
    <option>Days</option>
    <option value="3">3
    <option value="7">7
    <option value="14">14
    <option value="30">30
    <option value="100">100
    <option value="365">365
  </select>
  <input type="hidden" name="subdelinact" value="1">
  <input type="submit" value="Delete All Inactive">
</form>



<!--/* Ban User */-->
<h3>Ban User</h3>
<?php echo $form->error("banuser"); ?>

<form action="adminprocess.php" method="POST">
  <input type="text" name="banuser" maxlength="30" value="<?php echo $form->value("banuser"); ?>" placeholder="Username">
  <input type="hidden" name="subbanuser" value="1">
  <input type="submit" value="Ban User">
</form>


<!--/* Display Banned Users Table */-->
<h3>Banned Users Table Contents:</h3>
<?php displayBannedUsers(); ?>

<!--/* Delete Banned User */-->
<h3>Delete Banned User</h3>
<?php echo $form->error("delbanuser"); ?>

<form action="adminprocess.php" method="POST">
  <input type="text" name="delbanuser" maxlength="30" value="<?php echo $form->value("delbanuser"); ?>" placeholder="Username">
  <input type="hidden" name="subdelbanned" value="1">
  <input type="submit" value="Delete Banned User">
</form>


</body>
</html>
<?php } ?>

