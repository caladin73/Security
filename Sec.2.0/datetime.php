<?php
/**
 * Created by PhpStorm.
 * User: Peter_Laptop
 * Date: 23-04-2018
 * Time: 21:54
 */

date_default_timezone_set("UTC");
echo "UTC:".time();

echo "<br>";

$date = date('Y-m-d H:i:s');
echo $date;

echo "<br>";
$date = new DateTime();
echo $date->getTimestamp(). "<br>";

echo "<br>";
$time_now = date("Y-d-m H:i:s");
$time_in_10 = date("Y/d/m h:i:s a", time() + 10);


echo $time_now . "<br>";
echo $time_in_10 . "<br>";

if ($time_now > $time_in_10)
{
    echo "true";
}
else {
    echo "false";
}

echo "<br>";

$selectedTime = date('Y-m-d H:i:s');
$endTime = strtotime("+10 seconds", strtotime($selectedTime));
echo date('Y-m-d H:i:s', $endTime);