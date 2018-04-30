<?php
require_once 'DbHSec.inc.php';
DbHSec::better_session_start();
// Unset all session values / a bit much in an unnamed session
$_SESSION = array();
// Destroy session cookie on server
session_destroy();
header('Location: ./login3.php');