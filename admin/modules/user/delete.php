<?php
    $open = "user";
    require_once __DIR__."/../../autoload/autoload.php";
    $id = intval(getInput('id'));
    $Deleteuser = $db->fetchId("users",$id);
    if (empty($Deleteuser)) {
            $_SESSION['error'] = "Dữ liệu không tồn tại!";
            redirectAdmin("user");
    }
    $num = $db->delete("users",$id);
    if ($num>0) {
        $_SESSION['success'] = "Xóa thành công! ";
        redirectAdmin("user");
    }
    else{
        $_SESSION['error'] = "Xóa thất bại!";
        redirectAdmin("user");
    }


    //tự code
    // if (isset($DeleteCategory)) {
    //     $db->delete('category',$id);
    //      $_SESSION['info'] = "Xóa thành công!";
    //     redirectuser('category');

    // }
 ?>
             