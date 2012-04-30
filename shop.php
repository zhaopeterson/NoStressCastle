<?php

// This file lists categories of products.
// This script is begun in Chapter 8.

// Require the configuration before any PHP code:
require ('./includes_nsc/config.inc.php');

// Validate the product type...
if (isset($_GET['type']) && ($_GET['type'] == 'desserts')) {
	$page_title = 'Our Other Desserts, by Category';
	$sp_type = 'other';
	$type = 'desserts';
} else { // Default is coffee!
	$page_title = 'Our Cake Products';
	$type = $sp_type = 'cake';	
}

// Include the header file:
include ('./includes_nsc/header.html');

// Require the database connection:
require (MYSQL);

// Call the stored procedure:
$r = mysqli_query($dbc, "CALL select_leftnav('$sp_type')");
if (mysqli_num_rows($r) > 0) {
	include ('./views_nsc/list_leftnav2.html');
	
}
mysqli_next_result($dbc);
$r = mysqli_query($dbc, "CALL select_categories('$sp_type')");

// For debugging purposes:
if (!$r) echo mysqli_error($dbc);

// If records were returned, include the view file:
if (mysqli_num_rows($r) > 0) {

	include ('./views_nsc/list_categories.html');
} else { // Include the error page:
	include ('./views_nsc/error.html');
}

// Include the footer file:
include ('./includes_nsc/footer.html');
?>