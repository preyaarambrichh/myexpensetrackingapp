<?php
session_start();
if(session_destroy())
{
/*The user will be directed to the login page after logging out from the website*/
header("Location: login.php");
}
?>