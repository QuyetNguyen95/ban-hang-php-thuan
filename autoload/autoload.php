<?php
	session_start();
	require_once __DIR__."/../libraries/Database.php";
	require_once __DIR__."/../libraries/Function.php";
	$db = new Database();
	define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/tuanphuongphp/public/uploads/");
	//$_SERVER['DOCUMENT_ROOT'] Đường dẫn tới thư mục gốc như c:/wamp64/www
	//show category 
	$category1 = $db->fetchAll("category");
	//show thong tin san pham
	$sql = "SELECT * FROM products WHERE 1 ORDER BY id DESC LIMIT 3";
	$newProducts = $db->fetchsql($sql);
	$sql = "SELECT * FROM products WHERE 1 ORDER BY pay DESC LIMIT 3";
	$hotProducts = $db->fetchsql($sql);
?>