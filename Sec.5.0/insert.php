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

    $sql = "INSERT INTO abstract (enteredby, authors, reftitle, abstract)";
    $sql .= "  VALUES ('" . $uid . "'," . "'" . $authors . "'," . "'" . $reftitle . "'," . "'" . $abstract . "');";

    try {
        $s = $dbh->prepare($sql);
        $s->execute();
        header("Location: ./login0p2.php");
    } catch (PDOException $e) {
        die(sprintf("Unexpected error<br/>\n", $e->getMessage()));
    }
} else {
    header("Location: ./login0.php?err=noData");
}