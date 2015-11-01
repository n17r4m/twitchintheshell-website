<?php
    require_once 'vendor/autoload.php';
    require 'includes/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Twitch Installs - Verification</title>

        <link rel="stylesheet" type="text/css" href="assets/css/main.css">

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <div id="wrapper">
            <img src="assets/img/logo.png" alt="Twitch Installs Arch Linux"><br>

            <form action="verify.php" method="POST">
                <input type="text" name="username" placeholder="Username" id="username"><br>
                <div class="g-recaptcha" data-sitekey="<?php echo getenv('RECAPTCHA_PUBLICKEY'); ?>"></div><br>
                <input type="submit" value="Submit">
            </form>
        </div>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    </body>
</html>
