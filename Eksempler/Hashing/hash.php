<!doctype html>
<html>
<head>
    <title>Hashing</title>
    <style>
        body { font-family: monospace;
            font-size: 1.25em; }
        table, td {border-collapse: collapse;
            border: 1px solid blue;}
        table { margin-top: 1em; }
    </style>
</head>
<body>
<form action="" method='GET'>
    <input name='input'/>
    <input type='submit' value='Go'/>
</form>
<?php
$input = isset($_GET['input']) ? $_GET['input'] : '';
if($input !== '') {
    $md5 = md5($input);
    $sha1 = hash("sha1", $input);
    $sha512 = hash("sha512", $input);
    $whirlpool = hash("whirlpool", $input);
    $bcrypt0 = password_hash($input, PASSWORD_DEFAULT);
    $bcrypt1 = password_hash($input, PASSWORD_DEFAULT);
    $bcrypt2 = password_hash($input, PASSWORD_DEFAULT);
    $blowfish = password_hash($input, PASSWORD_BCRYPT );
    printf("<h3><code>%s</code></h3>\n", $input);
    printf("<table><tr><td>md5</td><td>%s</td><td>%s</td></tr>
            <tr><td>sha1</td><td>%s</td><td>%s</td></tr>
            <td>sha512</td><td>%s</td><td>%s</td></tr>
            <tr><td>whirlpool</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_hash bcrypt0</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_hash bcrypt1</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_hash bcrypt2</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_hash blowfish</td><td>%s</td><td>%s</td></tr>\n",
        strlen($md5), $md5,
        strlen($sha1), $sha1,
        strlen($sha512), $sha512,
        strlen($whirlpool), $whirlpool,
        strlen($bcrypt0), $bcrypt0,
        strlen($bcrypt1), $bcrypt1,
        strlen($bcrypt2), $bcrypt2,
        strlen($blowfish), $blowfish;
    printf("<table>
            <tr><td>password_verify bcrypt0</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_verify bcrypt1</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_verify bcrypt2</td><td>%s</td><td>%s</td></tr>
            <tr><td>password_verify ...</td><td>%s</td><td>%s</td></tr>
            </table>\n",
        $input, password_verify($input, $bcrypt0) ? "match" : "no match",
        $input, password_verify($input, $bcrypt1) ? "match" : "no match",
        $input, password_verify($input, $bcrypt2) ? "match" : "no match",
        $input."0", password_verify($input."0", $bcrypt2) ? "match" : "no match");
}
?>
</body>
</html>