<?php
require_once 'DbHSec.inc.php';
DbHSec::better_session_start();
$dbh = DbHSec::getDbH();

if (count($_POST) > 0) {
    $sql = "select uid, realname, pwd";
    $sql .= " from user";
    $sql .= " where uid = :UID";
    $sql .= " and activated;";
    try {
        $s = $dbh->prepare($sql);
        $s->bindValue(':UID', $_POST['user'], PDO::PARAM_STR);
        $s->execute();
        $obj  = $s->fetch(PDO::FETCH_OBJ);
        if ($obj && password_verify($_POST['password'], $obj->pwd)) {
            $_SESSION['demoLoginId'] = $obj->uid;
            header("Location: ./login3.php?success");
        } else {
            unset($_SESSION['demoLoginId']);
            header("Location: ./login3.php?err=noSuccess");
        }
    } catch (PDOException $e) {
        die(sprintf("Unexpected error<br/>\n", $e->getMessage()));
    }
} else {
    header("Location: ./login3.php?err=noData");
}