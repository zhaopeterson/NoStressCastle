<?php // This page is included by shop.php.
// This page displays the individual categories.
// This page will make use of the query result $r.
// The query returns an array of: id, category, description, and image.
?>


</div><!--end of leftnav-->

<div id="main_content">


<?php while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { // Fetch each item.
	
	// Print the item within some HTML:
    echo '<div class="product_category_container">';
    echo '<div class="product_category_container_inner">';
	echo '<h3>' . $row['category'] . ' </h3>
                <img alt="' . $row['category'] . '" src="/images_products_nsc/' . $row['image'] . '" width="160" height="120" /> <p>' . $row['description'] . '<br />
                <a href="/browse/' . $type . '/' . urlencode($row['category']) . '/' . $row['id'] . '" class="h4">View All ' . $row['category'] . ' Products &raquo;</a></p>
             </div></div>';	

}?> 
              
