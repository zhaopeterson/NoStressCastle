<?php

// This file is the first step in the checkout process.
// It takes and validates the shipping information.
// This script is begun in Chapter 10.

// Require the configuration before any PHP code:
require ('./includes_nsc/config.inc.php');

// Check for the user's session ID, to retrieve the cart contents:
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (isset($_GET['session'])) {
		$uid = $_GET['session'];
		//echo $uid;//added oct 23
		// Use the existing user ID:
		session_id($uid);
		// Start the session:
		session_start();
		
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include ('./includes_nsc/login.inc.php');
}
include ('./includes_nsc/header.html');
require_once ('./includes_nsc/form_functions.inc.php');
require ('./includes_nsc/login_form.inc.php');
	} else { // Redirect the user.
		$location = '/cart.php';
		header("Location: $location");
		exit();
	}
} else { // POST request.
	session_start();
	$uid = session_id();
}
require('../mysql.inc.php');
$login_errors = array();						
// Include the header file:
$page_title = 'No Stress Castle - Checkout - You may use guest checkout';

	//echo "cheout with login";
	//include the login page



// Finish the page:
?>
<?php

?>



<?php
include ('./includes_nsc/footer.html');
?>