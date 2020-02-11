<?php
    $open = "category";
	require_once __DIR__."/../../autoload/autoload.php";
	
	$id = intval(getInput('id'));

	$homeCategory = $db->fetchID("category",$id);

	if (empty($homeCategory)) {
		$_SESSION['error'] = "Dữ liệu không tồn tại";
		redirectAdmin('category');
	}

	$home = $homeCategory['home'] == 0 ? 1 : 0;
	$update = $db->update("category",array('home'=>$home),array('id'=>$id));
	 if ($update>0) {
        $_SESSION['success'] = "Cập nhật thành công! ";
        redirectAdmin("category");
    }
    else{
        $_SESSION['error'] = "Dữ liệu không thay đổi!";
        redirectAdmin("category");
    }
 ?>