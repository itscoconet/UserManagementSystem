<?php
include_once("../include/session.php");

// ** Simple Function to convert timestamp to time ago;
function timeago($date) {
   $timestamp = strtotime("@".$date);   
      
   $strTime = array("second", "minute", "hour", "day", "month", "year");
   $length = array("60","60","24","30","12","10");

   $currentTime = time();
   if($currentTime >= $timestamp) {
      $diff     = time()- $timestamp;
      for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
         $diff = $diff / $length[$i];
      }

      $diff = round($diff);
      if($diff <= 1){
         return $diff . " " . $strTime[$i] . " ago ";
      }else{
         return $diff . " " . $strTime[$i] . "s ago ";
      }
   }
}


/**
 * displayUsers - Displays the users database table in
 * a nicely formatted html table.
 */
function displayUsers(){
   global $database;
   $q = "SELECT username, userlevel, email, timestamp FROM ".TBL_USERS." ORDER BY userlevel DESC, username";
   $result = $database->query($q);

   /* Error occurred, return given name by default */
   $num_rows = $result->num_rows;
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "Database table empty";
      return;
   }


   /* Display table contents */
   echo "<table> \n";
   echo "<tr> \n";
   echo "<td>Username</td> \n";
   echo "<td>Level</td> \n";
   echo "<td>Email</td> \n";
   echo "<td>Last Active</td> \n";
   echo "</tr> \n";

   while($row = $result->fetch_assoc()) {
      $uname  = $row['username'];

      if($row['userlevel'] == 9){
         $ulevel = "administrator";
      }
      if($row['userlevel'] == 1){
         $ulevel = "user";
      }
      $email  = $row['email'];
      $time   = timeago($row['timestamp']);

      echo "<tr> \n";
      echo "<td>$uname</td>  \n";
      echo "<td>$ulevel</td>  \n";
      echo "<td>$email</td> \n";
      echo "<td>$time</td> \n";
      echo "</tr> \n";
   }
   echo "</table> \n";
}

/**
 * displayBannedUsers - Displays the banned users
 * database table in a nicely formatted html table.
 */
function displayBannedUsers(){
   global $database;
   $q = "SELECT username,timestamp "
       ."FROM ".TBL_BANNED_USERS." ORDER BY username";
   $result = $database->query($q);
   /* Error occurred, return given name by default */
   $num_rows = $result->num_rows;
   if(!$result || ($num_rows < 0)){
      echo "Error displaying info";
      return;
   }
   if($num_rows == 0){
      echo "Database table empty";
      return;
   }
   /* Display table contents */
   echo "<table> \n";
   echo "<tr> \n";
   echo "<td>Username</td> \n";
   echo "<td>Time banned</td> \n";
   echo "</tr> \n";

   while($row = $result->fetch_assoc()) {
      $uname  = $row['username'];
      $time   = date("m-d-Y",$row['timestamp']);

      echo "<tr> \n";
      echo "<td>$uname</td>  \n";
      echo "<td>$time</td> \n";
      echo "</tr> \n";
   }
   echo "</table><br>\n";
}

?>