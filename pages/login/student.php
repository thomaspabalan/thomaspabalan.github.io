<?php
    include 'dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/login.css"> <!-- css link -->

    <!-- font links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">

    <title>TSU | Student Login</title>
</head>
<body>
    <div class = "page">
        <div class="border-accent">&nbsp;<!-- filler so div shows --></div>

        <div class="main-area">
            <div class="main-area-header">S T U D E N T&nbsp;&nbsp;&nbsp;L O G I N</div>
            <div class="login-container">
                <p class="login-form-header">E n t e r&nbsp;&nbsp;&nbsp;s t u d e n t&nbsp;&nbsp;&nbsp;c r e d e n t i a l s</p>
                <form class="login-form" action="controller.php" method="post">
                    S t u d e n t&nbsp;&nbsp;&nbsp;N u m b e r :
                    <br>
                    <input type="text" name="studentNum" style="width: 100%;">
                    <br>
                    P a s s w o r d :
                    <br>
                    <input type="password" name="password" style="width: 100%;">
                    <br>
                    <input type="submit" name = "login" value="L O G - I N" id="login-button">
                </form>
            </div>
            <a class="back" href="../../index.html">H O M E</a>
        </div>

        <div class="border-accent">
            <p>&nbsp;</p> <!-- filler so div shows -->
        </div>
    </div>
</body>
</html>