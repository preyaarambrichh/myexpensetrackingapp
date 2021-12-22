<?php
/* These are my credentials from AEONFREE Control Panel which helped in hosting this website online*/
$con = mysqli_connect("sql209.iceiy.com","icei_30350308","CZOcGl07dDm1","icei_30350308_dailyexpense");
if (mysqli_connect_errno())
  {

  /* An error message is displayed on the screen if the user did not created a Database and import the necessary SQL file in localhost*/
  echo "Failed to connect to MySQL: " . mysqli_connect_error() ." | Seems like you haven't created the DATABASE with an exact name";
  }
?>