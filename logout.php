<?php
session_start();
// Unset all of the session variables.
$_SESSION = array();
// Destroy the session
session_destroy();
// header(location:index.php);
// Print out the confirmation page
include_once("home_start.php");
echo "<h1>You have logged out.</h1>
<p>Go to the <a href='index.php'>homepage</a> or
<a href='login.php'>log back in</a>.</p>";
require_once("home_end.php");
?>
