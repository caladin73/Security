<?php
/*
 * Based on Chris Shiflett, Essential PHP Security, 2005, O'Reilly
 * Chapter 7
 */


if (count($argv) != 5) {
    $s = "php bruteforce_hash_vertify.php -- passwords password_hashed results\n";
    die($s);
}

/**
 *php bruteforce_hash_vertify.php -- darkpwds.txt password_hashed.txt darkresults.txt
 * 5 argv
 * 0 = bruteforce_hash_vertify.php
 * 1 = --
 * 2 = darkpwds.txt
 * 3 = password_hashed.txt
 * 4 = darkresults.txt
*/

foreach($argv as $value)
{
    echo "$value\n";
}

die();

$passwords = file_get_contents($argv[2]);
$pas = explode("\r\n", $passwords);
$hashed = file_get_contents($argv[3]);
$pass_hashed = explode("\r\n", $hashed);
$results = $argv[4];

$s = '';
foreach($pass as $item) {
    foreach($pass_hashed as $value) {



        $response = '';
        file_put_contents($results, $s);



    }
}
echo "\n";
