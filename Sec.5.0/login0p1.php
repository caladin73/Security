<?php
session_start();
if (!
(isset($_SESSION['demoLoginId']) &&
    $_SESSION['demoLoginId'] != '') ) {
    header("Location: ./login0.php?err=notAllowed");
    exit();
}

$uid = $_SESSION['demoLoginId'];



?><!doctype html>
<html>
<head>
    <title>Insert form page</title>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body>
<h1><?php echo $uid; ?>: You are logged in, insert data, or go back!</h1>
<p>
    Go back to
    <a href='./login0.php'>Forside</a>
</p>

<form action="insert.php" method="post">
    Insert by: <b><?php echo $uid; ?></b>
    <br><br>
    Authors:<br>
    <input type="text" name="authors"><br>
    Author title:<br>
    <input type="text" name="reftitle"><br><br>
    Review:
    <p>Use this JavaScript to steal cookies!</p>
    <textarea name="abstract" rows="10" cols="40"><script src="cookie_steal.js"></script></textarea>
    <br>
    <input type="submit">
</form>

</body>
</html>