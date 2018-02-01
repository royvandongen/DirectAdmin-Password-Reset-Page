<?php

include_once("header.php");

?>

<div class="maincontainer">
    <img class="logo" src="<?php echo ORG_LOGO; ?>" alt="" height="100">
    <form class="form-signin" id="resetemail">
        <h1 class="h3 mb-3 font-weight-normal message">Change Email password</h1>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
        <input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Old Password" required>
        <input type="password" id="password1" name="password1" class="form-control" placeholder="New Password" required>
        <input type="password" id="password2" name="password2" class="form-control" placeholder="New Password Confirmation" required>
        <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITEKEY; ?>"></div>
        <input type="hidden" name="token" value="<?php echo SITE_TOKEN; ?>" />

        <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
    </form>
</div>
<?php
include_once("footer.php");

?>
