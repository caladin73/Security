<?php

require_once('DbH.inc.php');
$dbh = DbH::getDbH();

$sql = "SELECT * FROM abstract";

try {
    $s = $dbh->prepare($sql);
    $s->execute();

    $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($sql->fetchAll())) as $k=>$v) {
        echo $v;
    }


?>

<!doctype html>
<html>
<head>
    <title>Login Demo  Page 2</title>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body>
<h1>Page 2 - You're In - Everbody's Allowed</h1>
<p>
    Go back to
    <a href='./login0.php'>Forside</a>
</p>
</body>
</html>