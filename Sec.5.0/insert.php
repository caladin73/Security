<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 01-05-2018
 * Time: 12:35
 */

session_start();
if (!
(isset($_SESSION['demoLoginId']) &&
    $_SESSION['demoLoginId'] != '') ) {
    header("Location: ./login0.php?err=notAllowed");
    exit();
}

require_once('DbH.inc.php');
$dbh = DbH::getDbH();



//INSERT INTO abstract (enteredby, authors, reftitle, abstract) VALUES ($uid, $authors, $reftitle, $abstract);

if (count($_POST) > 0) {

    $uid = $_SESSION['demoLoginId'];
    $authors = $_POST['authors'];
    $reftitle =  $_POST['reftitle'];
    $abstract =  $_POST['abstract'];

    echo "uid: " . $uid . "<br>";
    echo "authors: " . $authors . "<br>";
    echo "ureftitle: " . $reftitle . "<br>";
    echo "abstract: " . $abstract . "<br>";



    $sql = "INSERT INTO abstract (enteredby, authors, reftitle, abstract)";
    $sql .= "  VALUES ("'" . $uid . "'," .  $authors, $reftitle, $abstract);";

    var_dump($sql);
    die();


    try {
        $s = $dbh->prepare($sql);
        $s->execute();
        $obj  = $s->fetch(PDO::FETCH_OBJ);
        if ($obj && password_verify($_POST['password'], $obj->pwd)) {
            $_SESSION['demoLoginId'] = $obj->uid;
            header("Location: ./login0.php?success");
        } else {
            unset($_SESSION['demoLoginId']);
            header("Location: ./login0.php?err=noSuccess");
        }
    } catch (PDOException $e) {
        die(sprintf("Unexpected error<br/>\n", $e->getMessage()));
    }
} else {
    header("Location: ./login0.php?err=noData");
}