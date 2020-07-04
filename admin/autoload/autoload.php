<?php
	session_start();
	require_once __DIR__."/../../libraries/Database.php";
	require_once __DIR__."/../../libraries/Function.php";
	$db = new Database();
	define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/tuanphuongphp/public/uploads/");
	//đường dẫn đến hình ảnh
	//$_SERVER['DOCUMENT_ROOT'] Đường dẫn tới thư mục gốc như c:/xampp/htdocs

	//kiểm tra đã đăng nhập admin hay chưa nêu chưa đăng nhập thì trả về trang login admin
	if(!isset($_SESSION['admin_id'])){
		header("location: /tuanphuongphp/loginAdmin");
	}
?>