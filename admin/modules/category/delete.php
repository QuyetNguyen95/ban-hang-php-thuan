<?php
    $open = "category";
    require_once __DIR__."/../../autoload/autoload.php";
    $id = intval(getInput('id'));
    $DeleteCategory = $db->fetchId("category",$id);
    if (empty($DeleteCategory)) {
            $_SESSION['error'] = "Dữ liệu không tồn tại!";
            redirectAdmin("category");
    }
    //kiem tra danh muc co san pham
    $is_product = $db->fetchOne("products"," category_id = $id ");
    if ($is_product == NULL ) {
       
        $num = $db->delete("category",$id);

        if ($num>0) {
            $_SESSION['success'] = "Xóa thành công! ";
            redirectAdmin("category");
        }

        else{
            $_SESSION['error'] = "Xóa thất bại!";
            redirectAdmin("category");
        }
    }
    else
    {
        $_SESSION['error'] = "Danh mục có sản phẩm bạn không được xóa";
        redirectAdmin("category");
    }    


    //tự code
    // if (isset($DeleteCategory)) {
    //     $db->delete('category',$id);
    //      $_SESSION['info'] = "Xóa thành công!";
    //     redirectAdmin('category');

    // }
 ?>
             