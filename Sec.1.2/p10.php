<?php
    require_once 'DbSH.inc.php';
    DbSH::better_session_start();
    $_SESSION['var1'] = 'nml';
    $_SESSION['var2'] = 'test';
    $_SESSION['user'] = 'secret';
    $title = 'Sessions Page ';
    $page = 10;
    $hitme = 'http://x15.dk/hitme.php';

?><!doctype html>
<html>
    <head>
        <title><?php echo $title.$page;?></title>
        <meta charset='utf-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <h1><?php echo $title.$page;?></h1>
        <p><a href='<?php echo $hitme;?>'>Check it out at <?php echo $hitme;?></a></p>
        <p><a href='p11.php'><?php echo $title.($page+1);?></a></p>
        <p><a href='p12.php'><?php echo $title.($page+2);?></a></p>
    </body>
</html>
