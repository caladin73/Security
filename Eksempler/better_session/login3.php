<?php
require_once 'DbHSec.inc.php';
DbHSec::better_session_start();
$copy = "&copy; NML, 2018";
$title = 'Secure';

?><!doctype html>
<html>
<head>
    <title><?php print($title);?></title>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='demo0.css'/>
</head>
<body>
<header>
    <h1><?php print($title);?></h1>
</header>
<main>
    <section><?php
        if (!
        (isset($_SESSION['demoLoginId']) &&
            $_SESSION['demoLoginId'] != '') ) {
            ?>
            <h2>Cookies requried</h2>
            <form action="login3Auth.php" method="post">
                <fieldset>
                    <legend>login</legend>
                    <label for="uid">Id:</label>
                    <input id="uid" name="user"/><br/>
                    <label for="pwd">Password:</label>
                    <input type="password"
                           id="pwd" name="password"/><br/>
                    <input type="submit" value="Login"/>
                </fieldset>
            </form>
            <?php
        } else {
            ?>
            <h2>Logout</h2>
            <form action="login3DeAuth.php" method="post">
                <fieldset>
                    <legend>logout</legend>
                    <input type="submit" value="Logout"/>
                </fieldset>
            </form>
            <?php
        }
        ?>
        <p><a href='./login3p1.php'>Page 1</a></p>
        <p><a href='./login3p2.php'>Page 2</a></p>
    </section>
</main>
<footer><?php print($copy);?></footer>
</body>