<?php
    require_once 'DbSH.inc.php';
    DbSH::better_session_start();
    $_SESSION['frompage1'] = 'I am page 1';
    $title = 'Sessions Page ';
    $page = 11;

?><!doctype html>
<html>
    <head>
        <title><?php echo $title.$page;?></title>
        <meta charset='utf-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <h1><?php echo $title.$page;?></h1>
<?php
if ($_SESSION) {
    printf("<h2 style='color:red;'>Content of the %s array</h2>\n", '$_SESSION');
    foreach ($_SESSION as $key => $val)
        printf("%s = %s<br />\n", $key, $val);
}

if ($_COOKIE) {
    printf("<h2 style='color:red;'>Content of the %s array</h2>\n", '$_COOKIE');
    foreach ($_COOKIE as $key => $val)
        printf("%s = %s<br />\n", $key, $val);
}
?>
        <p>
            Go back to
            <a href='./p10.php'><?php echo $title.($page-1);?></a>
        </p>
    </body>
</html>
