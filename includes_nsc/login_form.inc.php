<?php

// This script displays the login form.
// This script is included by footer.html, if the user isn't logged in.
// This script is created in Chapter 4.

// Create an empty error array if it doesn't already exist:
if (!isset($login_errors)) $login_errors = array();

// Need the form functions script, which defines create_form_input():
// The file may already have been included (e.g., if this is register.php or forgot_password.php).
require_once ('./includes_nsc/form_functions.inc.php');
?>
<div class="checkout_choices">
<div id="login_box">
  <p id="login_note">Already Registered? Please sign in below:</p>

<form action="checkout3.php" method="post" accept-charset="utf-8">
 
    <?php if (array_key_exists('login', $login_errors)) {
	echo '<span class="error">' . $login_errors['login'] . '</span><br />';
	}?>
    <p><label for="email"><strong>Email </strong></label>
   
    <?php create_form_input('email', 'text', $login_errors); ?><p>
   <p>
    <label for="pass"><strong>Password</strong></label>
 
    <?php create_form_input('pass', 'password', $login_errors); ?></p>
   <p> <a href="forgot_password.php" align="right">Forgot?</a></p>
    <p><input type="submit" value="Login &rarr;">
  </p>
</form>

<p id="register_note">Do not have an account yet? Register now to use promotional code and special offers!</p>
<p><img src="/images_nsc/bkg_cafeincity_register.jpg" /></p>
</div>
<div id="guest_checout">
<p>&#160;</p>
<p id="text_guestcheckout"><a href="/checkout2.php?session=<?php echo $uid; ?>" >Checkout as a guest, you may register later for a faster checkout.</a></p>
<p><a href="/checkout2.php?session=<?php echo $uid; ?>" ><img src="/images_nsc/bkg_guestcheckout2.jpg" /></a></p>

</div><!--end of guest check out-->

</div><!--end of check out choices-->