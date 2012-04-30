<?php
require('./includes_nsc/config.inc.php');
$page_title='No Stress Castle --Sprit Candies for the Soul!';
include('./includes_nsc/header_home.html');
require('../mysql.inc.php');
$r=mysqli_query($dbc, "CALL select_sale_items(false)");
include('./views_nsc/home.html');
include('./includes_nsc/footer_home.html');
?>