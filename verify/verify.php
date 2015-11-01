<?php
/*
 * Verifies user
 */

ini_set('ERROR_REPORTING', E_ALL);

require_once 'vendor/autoload.php';
require 'includes/init.php';

if (isset($_POST['username'], $_POST['g-recaptcha-response'])) {
    $token = $_POST['g-recaptcha-response'];
    $username = $_POST['username'];

    if (TwitchVerification\Verify::verify_captcha($token, $username)) {
        TwitchVerification\Verify::authorize_user($username);
        header('Location: thankyou.php');
    } else {
        header('Location: index.php?fail=1');
    }
}
