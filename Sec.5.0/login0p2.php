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

//cookie 1 with 60 secunds lifespand
$cookie_1 = "cookie1";
$cookie_1_value = "Number one";
setcookie($cookie_1, $cookie_1_value, time() + (60), "/");

//cookie 2 with no life span specification
$cookie_2 = "cookie2";
$cookie_2_value = "Number two";
setcookie($cookie_2, $cookie_2_value);

//All cookies expire as per the cookie specification, so this is not a PHP limitation.
//http://www.faqs.org/rfcs/rfc2965.html
//I set a cookie that last for 10 years
//time() + (10 * 365 * 24 * 60 * 60)
//Be careful: if you set a date past year 2038 in PHP,
// the number will wrap around and you'll get a cookie
// that expires instantly (it will reset seconds counting back to 0 from 1 jan 1970)
$cookie_3 = "cookie3";
$cookie_3_value = "Number tree";
setcookie($cookie_3, $cookie_3_value, time() + (10 * 365 * 24 * 60 * 60));

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