<?php
/**
 *
 * DirectAdmin API implementation
 *
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 * @link http://www.directadmin.com/api.html
 *
 */

require_once("config.inc.php");
require_once("lib/DirectAdmin/DirectAdmin.php");
require_once("lib/recaptcha/src/autoload.php");

$debug = 0;

if($_POST['token'] == SITE_TOKEN) {

    if(empty($_POST["email"]) || empty($_POST["oldpassword"]) || empty($_POST["password1"]) || empty($_POST["password2"])) {
        header('HTTP/1.1 400 Bad Request');
        header('x-error-response: Please fill in all fields');
        die();
    }

    if($_POST["password1"] != $_POST["password2"]) {
        header('HTTP/1.1 400 Bad Request');
        header('x-error-response: Passwords do not match');
        die();
    }

    if($_POST["password1"] == $_POST["oldpassword"]) {
        header('HTTP/1.1 400 Bad Request');
        header('x-error-response: Please choose a new password');
        die();
    }


    $email = $_POST["email"];
    $oldpassword = $_POST["oldpassword"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    $recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET);
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if ($resp->isSuccess()) {
	$result = GetAPI("/CMD_CHANGE_EMAIL_PASSWORD","email=" . $email . "&oldpassword=" . $oldpassword . "&password1=" . $password1 . "&password2=" . $password2);

        if (strpos($result, 'Password Saved') !== false) {
            if( $debug == 1) { syslog(LOG_INFO, "RESETPASSWD: Succesfull reset for user: " . $email); }

            echo "Password Changed";
        } else {
            if( $debug == 1) { syslog(LOG_INFO, "RESETPASSWD: Unsuccesfull reset for user: " . $email); }

            header('HTTP/1.1 400 Bad Request');
            header('x-error-response: ERROR! Password not changed');
            die();
        }
    } else {

        if( $debug == 1) { syslog(LOG_INFO, "RESETPASSWD: Invalid Captcha for user: " . $email); }

        header('HTTP/1.1 400 Bad Request');
        header('x-error-response: Captcha not OK');
    }

} else {
    if( $debug == 1) { syslog(LOG_INFO, "RESETPASSWD: Invalid Token for user: " . $email); }

    header('HTTP/1.1 400 Bad Request');
    header('x-error-response: Token not OK');
}

function GetAPI($apicommand, $options) {
    $da = new \DirectAdmin\DirectAdmin();
    $da->connect(DA_HOST, DA_PORT);
    $da->set_login(DA_USER,DA_PASS);

    $da->set_method('get');
    $da->query($apicommand,$options);
    $da = $da->fetch_body();

    return $da;
}

?>
