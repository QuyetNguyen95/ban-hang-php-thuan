<?php
    $open = "admin";
    require_once __DIR__."/../../autoload/autoload.php";
    $id = intval(getInput('id'));
    $Deletetran = $db->fetchId("transaction",$id);
    if (empty($Deletetran)) {
            $_SESSION['error'] = "Dữ liệu không tồn tại!";
            redirectAdmin("transaction");
    }
    $num = $db->delete("transaction",$id);
    if ($num>0) {
        $_SESSION['success'] = "Xóa thành công! ";
        redirectAdmin("transaction");
    }
    else{
        $_SESSION['error'] = "Xóa thất bại!";
        redirectAdmin("transaction");
    }


    //tự code
    // if (isset($DeleteCategory)) {
    //     $db->delete('category',$id);
    //      $_SESSION['info'] = "Xóa thành công!";
    //     redirectAdmin('category');

    // }
 ?>
             