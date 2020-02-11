<?php
    $open = "product";
    require_once __DIR__."/../../autoload/autoload.php";
    $id = intval(getInput('id'));
    $DeleteProduct = $db->fetchId("products",$id);
    if (empty($DeleteProduct)) {
            $_SESSION['error'] = "Dữ liệu không tồn tại!";
            redirectAdmin("category");
    }
    $num = $db->delete("products",$id);
    if ($num>0) {
        $_SESSION['success'] = "Xóa thành công! ";
        redirectAdmin("product");
    }
    else{
        $_SESSION['error'] = "Xóa thất bại!";
        redirectAdmin("product");
    }


    //tự code
    // if (isset($DeleteCategory)) {
    //     $db->delete('category',$id);
    //      $_SESSION['info'] = "Xóa thành công!";
    //     redirectAdmin('category');

    // }
 ?>
             