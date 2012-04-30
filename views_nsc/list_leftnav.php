<?php // This page is included by shop.php.
// This page displays the individual categories.
// This page will make use of the query result $r.
// The query returns an array of: id, category, description, and image.
?>
<ul>
<?php

if ($type=="cake"){
$q="SELECT category FROM cake_categories ORDER BY id";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) {
	


 while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { // Fetch each item.
	
	// Print the item within some HTML:
   
	echo '<li>' . $row['category'] . ' </li>';
                

}
}

}elseif($type=="desserts"){
$q2="SELECT category FROM non_cake_categories ORDER BY id";
$r2 = mysqli_query($dbc, $q2);
if (mysqli_num_rows($r2) > 0) {
	


 while ($row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)) { // Fetch each item.
	
	// Print the item within some HTML:
   
	echo '<li>' . $row2['category'] . ' </li>';
                

}
}

}
?>
              
</ul>