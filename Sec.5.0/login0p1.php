<?php
session_start();
if (!
(isset($_SESSION['demoLoginId']) &&
    $_SESSION['demoLoginId'] != '') ) {
    header("Location: ./login0.php?err=notAllowed");
    exit();
}

//INSERT FORM



?><!doctype html>
<html>
<head>
    <title>Insert form page</title>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body>
<h1>You are logged in, insert data, or..</h1>
<p>
    Go back to
    <a href='./login0.php'>Forside</a>
</p>

<form>
    First name:<br>
    <input type="text" name="firstname"><br>
    Last name:<br>
    <input type="text" name="lastname">
</form>

</body>
</html>