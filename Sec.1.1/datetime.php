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