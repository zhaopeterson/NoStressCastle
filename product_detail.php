
<?php
require ('./includes_nsc/config.inc.php');

$page_title="NO Stress Castle -- Product detail";
include ('./includes_nsc/header.html');
if(isset($_GET['type'], $_GET['category'], $_GET['id'], $_GET['product_name'])){
	$product_name=$_GET['product_name'];
	//echo $product_name."<br />";
	$type=$_GET['type'];
	//echo $type."<br />";
	$category=$_GET['category'];
	//echo $category."<br />";
	$sp_type="other";
	$sp_cat = $_GET['id'];
	//echo $sp_cat;
include('../mysql.inc.php');
include ('./includes_nsc/product_functions.inc.php');
$r = mysqli_query($dbc, "CALL select_leftnav('$sp_type')");
if (mysqli_num_rows($r) > 0) {
	include ('./views_nsc/list_leftnav2.html');
	
}
mysqli_next_result($dbc);

$r=mysqli_query($dbc, "CALL select_productdetail('$product_name')");
//print_r($r);

 if (mysqli_num_rows($r) > 0){

	mysqli_next_result($dbc);
include('./views_nsc/product_detail.html');

			
$r2=mysqli_query($dbc, "CALL select_reviews('$sp_type', $sp_cat)");

	if((mysqli_num_rows($r2) > 0)) {
		include ('./views_nsc/list_reviews.html');
	} else{
		
		include('./includes_nsc/reviews_form.inc.php');
	}
	
	//include crossselling
	//include cross-selling
	mysqli_next_result($dbc);
	$rc=mysqli_query($dbc, "CALL select_crossselling_dessert('$product_name')");
	include('./views_nsc/list_crossselling_dessert.html');
	
	mysqli_next_result($dbc);
	$rc2=mysqli_query($dbc, "CALL select_crossselling_cakeondessert()");
	include('./views_nsc/list_crossselling_cakeondessert.html');

}else{
	echo "A system error occured, we can not locate the product.";
}
}else{
	/*$product_name=$_GET['product_name'];
	echo"Get product valye".$_GET['product_name'];
	echo "product_name".$product_name."<br />";
	$type=$_GET['type'];
	echo $type."<br />";
	$category=$_GET['category'];
	echo $category."<br />";
	$sp_type="other";
	$sp_cat = $_GET['id'];
	echo $sp_cat;*/
	
}//end of if get

include ('./includes_nsc/footer.html');
 ?>
      
  

