<?php
	require_once __DIR__."/autoload/autoload.php";
   if (!isset($_SESSION['name'])) {
        echo "<script> alert('Bạn phải đăng nhập mới thức hiện được chức năng này'); location.href='index.php' </script>";
    }
    //lấy id sản phẩm trên url
    $id = intval(getInput('id'));
    //lấy toàn bộ thông tin sản phẩm theo id
    $product = $db->fetchID("products",$id);
    //neu chua co gio hang thi tao moi
    if (!isset($_SESSION['cart'][$id])) {
    	$_SESSION['cart'][$id]['name'] = $product['name'];
    	$_SESSION['cart'][$id]['image'] = $product['image'];
    	$_SESSION['cart'][$id]['qty'] = 1;
    	$_SESSION['cart'][$id]['price'] = $product['price']*(1-$product['sale']/100);
    }else
    {
    	//update gio hang 
    	$_SESSION['cart'][$id]['qty'] += 1;
    }

    echo "<script> alert('Thêm sản phẩm thành công'); location.href='gio-hang.php' </script>";
    
?>
