<?php
session_start();
require_once('DbH.inc.php');
$dbh = DbH::getDbH();

//Example 45.10. Authentication Code, the Wrong Way
//sql injection vulnerable
if (count($_POST) > 0) {
    $sql = "select uid, realname, pwd";
    $sql .= " from user";
    $sql .= " where uid = '". $_POST['user'] ."'";
    $sql .= " and pwd = '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "'";
    $sql .= " and activated;";

    //printf($sql);
    //var_dump($sql);
    //die();
    try {
        $s = $dbh->prepare($sql);
        $s->execute();
        $obj  = $s->fetch(PDO::FETCH_OBJ);
        if ($obj) {
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