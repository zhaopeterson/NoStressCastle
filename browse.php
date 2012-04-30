<?php
//echo "This is the brwose.php file";
// This file lists products in a specific category
// This script is begun in Chapter 8.

// Require the configuration before any PHP code:
require ('./includes_nsc/config.inc.php');

// Validate the required values:
$type = $sp_type = $sp_cat = $category = false;
if (isset($_GET['type'], $_GET['category'], $_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
	
	// Make the associations:
	$category = $_GET['category'];
	$sp_cat = $_GET['id'];
	
	// Validate the type:
	if ($_GET['type'] == 'desserts') {
		
		$sp_type = 'other';
		$type = 'desserts';
		
	} elseif ($_GET['type'] == 'cake') {
		
		$type = $sp_type = 'cake';	
		
	}

}

// If there's a problem, display the error page:
if (!$type || !$sp_type || !$sp_cat || !$category) {
	$page_title = 'Error!';
	include ('./includes_nsc/header.html');
	include ('./views_nsc/error.html');
	include ('./includes_nsc/footer.html');
	exit();
}

// Create a page title:
$page_title = ucfirst($type) . ' to Buy::' . $category;

// Include the header file:
include ('./includes_nsc/header.html');

// Require the database connection:
require (MYSQL);
//call the store procedure select leftnav

$r = mysqli_query($dbc, "CALL select_leftnav('$sp_type')");
if (mysqli_num_rows($r) > 0) {
	include ('./views_nsc/list_leftnav2.html');
	
}
mysqli_next_result($dbc);
// Call the stored procedure:
$r = mysqli_query($dbc, "CALL select_products('$sp_type', $sp_cat)");

// For debugging purposes:
if (!$r) echo mysqli_error($dbc);

// If records were returned, include the view file:
if (mysqli_num_rows($r) > 0) {
	if ($type == 'desserts') {

       
		include ('./views_nsc/list_desserts.html');
	} elseif ($type == 'cake') {
		mysqli_next_result($dbc);
			include ('./views_nsc/list_cakes.html');
			
$r2=mysqli_query($dbc, "CALL select_reviews('$sp_type', $sp_cat)");

	if((mysqli_num_rows($r2) > 0)) {
		include ('./views_nsc/list_reviews.html');
	} else{
		
		include('./includes_nsc/reviews_form.inc.php');
	}
	//include cross-selling
	mysqli_next_result($dbc);
	$rc=mysqli_query($dbc, "CALL select_crossselling_cake($sp_cat)");
	include('./views_nsc/list_crossselling_cake.html');
	
	mysqli_next_result($dbc);
	$rc2=mysqli_query($dbc, "CALL select_crossselling_dessertoncake");
	include('./views_nsc/list_crossselling_dessertoncake.html');
	}
} else { // Include the "noproducts" page:
	include ('./views_nsc/noproducts.html');
}

// Include the footer file:
include ('./includes_nsc/footer.html');
?>