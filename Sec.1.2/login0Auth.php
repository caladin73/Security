<?php
require_once 'DbSH.inc.php';
DbSH::better_session_start();
    //session_start();
    //require_once('DbH.inc.php');
    $dbh = DbSH::getDbH();

    // if there is content in POST authenticate
    // sqlinj vulnerable
    if (count($_POST) > 0) {
        $sql = "select uid, realname, pwd";
        $sql .= " from user";
        $sql .= " where uid = '". $_POST['user'] ."'";
        $sql .= " and activated;";
        try {
            $s = $dbh->prepare($sql);
            $s->execute();
            $obj  = $s->fetch(PDO::FETCH_OBJ);
            if ($obj && password_verify($_POST['password'], $obj->pwd)) {
                $_SESSION['demoLoginId'] = $obj->uid;
                $_SESSION['var1'] = 'nml';
                $_SESSION['var2'] = 'test';
                $_SESSION['user'] = 'secret';
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
