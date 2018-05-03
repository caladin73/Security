<!DOCTYPE html>
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

<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Entered by</th><th>Authors</th><th>Author title</th><th>Review</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

require_once('DbH.inc.php');
$dbh = DbH::getDbH();

try {
    $sql = "SELECT enteredby, authors, reftitle, abstract FROM abstract;";
    $s = $dbh->prepare($sql);
    $s->execute();

    // set the resulting array to associative
    $result = $s->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($s->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

</body>
</html>