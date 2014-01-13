<?php
session_start();
unset($_SESSION["loggedIn"]);
unset($_SESSION["loggedUser"]);
session_destroy();
header( 'Location: ../login.php');
?>