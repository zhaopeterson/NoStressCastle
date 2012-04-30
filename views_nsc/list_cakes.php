<?php // This page is included by browse.php.
// This page displays the available coffee products.
// This page will make use of the query result $r.
// The query returns an array of: description, image, sku, name, and stock.

// Only display the header once:
$header = false; 

// Added later in Chapter 8:
include ('/includes_nsc/product_functions.inc.php');

// Loop through the results:
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	
	// If the header hasn't been shown, create it:
	if (!$header) { ?>
		   </div><!--end of left_nav-->
	<div id="main_content_product">
	<div class="cakeimage_container">
		                 	<p><img alt="<?php echo $category; ?>" src="/images_products_nsc/<?php echo $row['image']; ?>" /></div>
                            
                            <div class="cakedesc_container">
                            <p> <?php echo $row['description']; ?></p>
                            <p>&#160;</p>
		<p class="product_availability">All listed products are currently available.</p>
		<form action="/cart.php" method="get"><input type="hidden" name="action" value="add" /><select name="sku">
<?php // The header has now been shown:
	$header = true;
} // End of $header IF.

	// Create each option:
   
	echo '<option value="' . $row['sku'] . '">' . $row['name'] .get_price($type, $row['price'], $row['sale_price']) . '</option>';
	
} // End of WHILE loop. 
?></select> <input type="submit" value="Add to Cart" class="button" /></p></form></div>
	
	
