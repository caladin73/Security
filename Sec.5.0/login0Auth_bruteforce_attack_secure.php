<?php
session_start();
require_once('DbH.inc.php');
$dbh = DbH::getDbH();

// if there is content in POST authenticate
// sqlinj vulnerable

$time_now = date('Y-m-d H:i:s');

if (count($_POST) > 0) {
    //finder tiden for sidste login forsøg i user table
    $sql = "select *";
    $sql .= " from user";
    $sql .= " where uid = '". $_POST['user'] ."'";
    $sql .= " and activated;";
    $s = $dbh->prepare($sql);
    $s->execute();
    $obj  = $s->fetch(PDO::FETCH_OBJ);
    $selectedTime = $obj->login_time;

    //konverter tider og lægger 10 sekunder til sidste login forsøg
    $endTime = strtotime("+10 seconds", strtotime($selectedTime));
    $time_last_plus_10_sec =  date('Y-m-d H:i:s', $endTime);

    //sætter if op så man kun kan logge ind efter 10 sek fra sidste login
    if ($time_now > $time_last_plus_10_sec) {
        $sql = "select *";
        $sql .= " from user";
        $sql .= " where uid = '" . $_POST['user'] . "'";
        $sql .= " and activated;";
        try {
            $s = $dbh->prepare($sql);
            $s->execute();
            $obj = $s->fetch(PDO::FETCH_OBJ);
            if ($obj && password_verify($_POST['password'], $obj->pwd)) {
                $_SESSION['demoLoginId'] = $obj->uid;
                header("Location: ./login0.php?success");
            } else {
                $sql = "update user";
                $sql .= " set login_time = '" . $time_now . "'";
                $sql .= " where uid = '" . $_POST['user'] . "'";
                $s = $dbh->prepare($sql);
                $s->execute();
                unset($_SESSION['demoLoginId']);
                header("Location: ./login0.php?err=noSuccess");
            }}
        catch (PDOException $e) {
            die(sprintf("Unexpected error<br/>\n", $e->getMessage()));
        }
    } else {
        header("Location: ./login0.php?err=noData");
    }
}


