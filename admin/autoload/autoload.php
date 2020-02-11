<?php
	session_start();
	require_once __DIR__."/../../libraries/Database.php";
	require_once __DIR__."/../../libraries/Function.php";
	$db = new Database();
	define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/tuanphuongphp/public/uploads/");
	//$_SERVER['DOCUMENT_ROOT'] Đường dẫn tới thư mục gốc như c:/wamp64/www
	if(!isset($_SESSION['admin_id'])){
		header("location: /tuanphuongphp/loginAdmin");
	}
?>