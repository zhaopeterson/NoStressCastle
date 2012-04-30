<?php
require('./includes_nsc/config.inc.php');
$page_title='No Stress Castle Sale Items';
include('./includes_nsc/header.html');
require(MYSQL);
$r=mysqli_query($dbc, 'CALL select_sale_items(true)');
if(mysqli_num_rows($r)>0) {
	include ('./views_nsc/list_sales.html');
} else{
	include('./views_nsc/noproducts.html');
}

include('./includes_nsc/footer.html');





?>