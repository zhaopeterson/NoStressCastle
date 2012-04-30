<?php //wishlist.php

require('./includes_nsc/config.inc.php');
if(isset($_COOKIE['SESSION'])){
	$uid=$_COOKIE['SESSION'];
}else{
	$uid=md5(uniqid('biped', true));
}
setcookie('SESSION', $uid, time()+(60*60*24*30));
$pge_title='Cake and Dessert -- Your Wish List';
include('./includes_nsc/header.html');
require('../mysql.inc.php');
include('./includes_nsc/product_functions.inc.php');
if(isset($_GET['sku'])){
	list($sp_type, $pid)=parse_sku($_GET['sku']);
}
if(isset($sp_type, $pid, $_GET['action'])&&($_GET['action']=='remove'))
{$r=mysqli_query($dbc, "CALL remove_from_wish_list('$uid', '$sp_type', $pid)");
	
}elseif(isset($sp_type, $pid, $_GET['action'], $_GET['qty'])&&($_GET['action']=='move')){
	$qty=(filter_var($_GET['qty'], FILTER_VALIDATE_INT, array('min_arange' =>1))) ? $_GET['qty']:1;
	$r=mysqli_query($dbc, "CALL add_to_wish_list('$uid', '$sp_type', $pid, $qty)");
	$r=mysqli_query($dbc, "CALL remove_from_cart('$uid', '$sp_type', $pid)");
}elseif(isset($_POST['quantity'])){
	foreach($POST['quantity'] as $sku => $qty){
		list($sp_type, $pid)=parse_sku($sku);
		if(isset($sp_type, $pid)){
			$qty=(filter_var($qty, FILTER_VALIDATE_INT, array('min_range' => 0))) ? $qty:1;
			$r=mysqli_query($dbc, "CALL update_wish_list('$uid', '$sp_type', $pid, $qty)");
		}
		
	}
	
}
$r=mysqli_query($dbc, "CALL get_wish_list_contents('$uid')");
if(mysqli_num_rows($r)>0){
	include('./views_nsc/wishlist.html');
}else{
	include('./views_nsc/emptylist.html');
}
include('./includes_nsc/footer.html');

?>
