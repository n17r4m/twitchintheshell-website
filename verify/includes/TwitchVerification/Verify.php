<?php
namespace TwitchVerification;

class Verify {
    public static function authorize_user($username, $ip = null)
    {
        if ($ip === null) { $ip = $_SERVER['REMOTE_ADDR']; } // defaults to remote address

        // Connect to database
        $database = new \PDO('mysql:host=' . getenv('MYSQL_HOST') . ';dbname=' . getenv('MYSQL_DATABASE'),
            getenv('MYSQL_USER'), getenv('MYSQL_PASS'));

        // Check if user is in database already
        $query = $database->prepare('SELECT id FROM users WHERE username=:username');
        $query->bindValue(':username', $username);
        $query->execute();
        if ($query->rowCount() > 0) {
            // Already in database
            return;
        }

        // Insert user into the database
        $query = $database->prepare('INSERT INTO users (username, added, ip) VALUES (:username, NOW(), :ip)');
        $query->bindValue(':username', $username);
        $query->bindValue(':ip', $ip);
        $query->execute(); // moment of truth
    }

    /**
     * Verifies a reCAPTCHA code
     * @param string $token Token received from client
     * @param string|null $ip IP address of client, or leave blank for requesting IP
     * @return bool Is captcha valid?
     */
    public static function verify_captcha($token, $ip = null)
    {
        if ($ip === null) { $ip = $_SERVER['REMOTE_ADDR']; } // defaults to remote address

        $recaptcha = new \ReCaptcha\ReCaptcha(getenv('RECAPTCHA_PRIVATEKEY'));
        $resp = $recaptcha->verify($token, $ip); // verify recaptcha

        return $resp->isSuccess();
    }
}
