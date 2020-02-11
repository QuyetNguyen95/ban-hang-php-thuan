<?php
	require_once __DIR__."/autoload/autoload.php";

	$key = intval(getInput("key"));
	$qty = intval(getInput("qty"));

	
	$product = $db->fetchID("products",$key);
	if ($qty> $product['number']) {
		echo 0;
	}
	else{
		$_SESSION['cart'][$key]['qty'] = $qty;
		echo 1;
	}
?>