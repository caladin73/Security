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

<p>Cookie set page, reload page after first visit!</p>

<!--countdown script in JavaScript-->
<p> Countdown <span id="countdowntimer">60 </span> Seconds</p>
<script type="text/javascript">
    var timeleft = 60;
    var downloadTimer = setInterval(function(){
        timeleft--;
        document.getElementById("countdowntimer").textContent = timeleft;
        if(timeleft <= 0)
            clearInterval(downloadTimer);
    },500);
</script>


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



?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_1])) {
    echo "Cookie named '" . $cookie_1 . "' is not set!";
} else {
    echo $cookie_1 . " is set! to expire in 60 sec.<br>";
    echo "Value is: " . $_COOKIE[$cookie_1];
}

echo "<br><br>";

if(!isset($_COOKIE[$cookie_2])) {
    echo "Cookie named '" . $cookie_2 . "' is not set!";
} else {
    echo $cookie_2 . " is set  with no life span!<br>";
    echo "Value is: " . $_COOKIE[$cookie_2];
}

echo "<br><br>";

if(!isset($_COOKIE[$cookie_3])) {
    echo "Cookie named '" . $cookie_3 . "' is not set!";
} else {
    echo $cookie_3 . " is set live a long as I can!<br>";
    echo "Value is: " . $_COOKIE[$cookie_3];
}

?>

</body>
</html>