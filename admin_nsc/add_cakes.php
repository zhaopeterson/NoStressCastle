<?php

// This file allows the administrator to add a specific coffee products.
// This script is created in Chapter 11.

// Require the configuration before any PHP code as configuration controls error reporting.
require ('../includes_nsc/config.inc.php');

// Set the page title and include the header:
$page_title = 'Add Cakes';
include ('./includes_admin/header_admin.html');
// The header file begins the session.

// Require the database connection:
require('../../mysql.inc.php');

// Number of possible specific coffees to add at once:
$count = 10;

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {	

	// Check for a category:
	if (isset($_POST['category']) && filter_var($_POST['category'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
		
		// Define the query:
		$q = 'INSERT INTO cake_products (category_id, size_id, cake_flavor, cake_filling, price, stock) VALUES (?, ?, ?, ?, ?, ?)';

		// Prepare the statement:
		$stmt = mysqli_prepare($dbc, $q);
		
		// Bind the variables:
		mysqli_stmt_bind_param($stmt, 'iissdi', $_POST['category'], $size, $cake_flavor, $cake_filling, $price, $stock);
		
		// Count the number of affected rows:
		$affected = 0;

		// Loop through each submission:
		for ($i = 1; $i <= $count; $i++) {
			
			// Validate the required values:
			if (filter_var($_POST['stock'][$i], FILTER_VALIDATE_INT, array('min_range' => 1))
			&& filter_var($_POST['price'][$i], FILTER_VALIDATE_FLOAT) 
			&& ($_POST['price'][$i] > 0) ) {
				
				// Assign the values to variables:
				$size = $_POST['size'][$i];
				$cake_flavor = $_POST['cake_flavor'][$i];
				$cake_filling = $_POST['cake_filling'][$i];
				$price = $_POST['price'][$i];
				$stock = $_POST['stock'][$i];
				
				// Execute the query:
				mysqli_stmt_execute($stmt);
				
				// Add to the affected rows:
				$affected += mysqli_stmt_affected_rows($stmt);
				
			} // End of IF.

		} // End of FOREACH.
		
		// Print the number of affected rows:
		echo "<h4>$affected Product(s) Were Created!</h4>";

	} else {
		echo '<p class="error">Please select a category.</p>';
	}

} // End of the submission IF.

?>
<div id="content_admin">
<h3>Add Cakes</h3>

<form action="add_cakes.php" method="post" accept-charset="utf-8">

	<fieldset><legend>Fill out the form to add cake products to the site.</legend>
		
		<label for="category"><strong>Cake Type</strong></label><br />
		<select name="category"><option>Select One</option>
		<?php // Retrieve all the categories and add to the pull-down menu:
		$q = 'SELECT id, category FROM cake_categories ORDER BY category ASC';		
		$r = mysqli_query ($dbc, $q);
			while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
				echo "<option value=\"$row[0]\">$row[1]</option>\n";
			}
		?>
		</select>
		
		<table border="0" width="100%" cellspacing="5" cellpadding="5">
			<thead>
				<tr>
			    <th align="right">Size</th>
			    <th align="right">Cake Flavor</th>
			    <th align="right">Cake Filling</th>
			    <th align="center">Price</th>
			    <th align="center">Quantity in Stock</th>
			  </tr>
			</thead>
			<tbody>
		<?php 
		
		// Need the available sizes:
		$q = 'SELECT id, size FROM sizes ORDER BY id ASC';		
		$r = mysqli_query ($dbc, $q);
		$sizes = '';
		while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
			$sizes .= "<option value=\"$row[0]\">$row[1]</option>\n";
		}
		
		// Need the available grind options:	
		$cake_flavor = '<option value="vanilla">Vanilla</option><option value="chocolate">Chocolate</option>';
		
		// Need the caffeinated/decaffeinated options:
		$cake_filling = '<option value="strawberry">Strawberry</option><option value="raspberry">Raspberry</option>';
		
		// Create a set of inputs for $count number of products:
		for ($i = 1; $i <= $count; $i++) {
			echo '<tr>
			<td align="right"><select name="size[' . $i . ']">' . $sizes . '</select></td>
			<td align="right"><select name="cake_flavor[' . $i . ']">' . $cake_flavor . '</select></td>
			<td align="right"><select name="cake_filling[' . $i . ']">' . $cake_filling . '</select></td>
		    <td align="center"><input type="text" name="price[' . $i . ']" class="small" /></td>
		    <td align="center"><input type="text" name="stock[' . $i . ']" class="small" /></td>
			</tr>
		';
			
		} // End of FOR loop.
		
		?></tbody>
		</table>

		<div class="field"><input type="submit" value="Add These Products" class="button" /></div>
	
	</fieldset>

</form> 

<?php // Include the HTML footer:
include ('./includes_admin/footer_admin.html');
?>