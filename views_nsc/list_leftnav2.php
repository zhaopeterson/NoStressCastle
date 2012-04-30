<?php // This page is included by shop.php.
// This page displays the individual categories.
// This page will make use of the query result $r.
// The query returns an array of: id, category, description, and image.
?>
<ul>
<?php

 while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { // Fetch each item.
	
	// Print the item within some HTML:
   
	echo '<li>' . $row['category'] . ' </li>';
                
}
?>
              
</ul>