<?php
    $open = "edituser";
	require_once __DIR__."/../autoload/autoload.php";

        $id = intval($_SESSION['id']);
        $EditAdmin = $db->fetchID("users",$id);
        if (empty($EditAdmin)) {
            $_SESSION['error'] = "Dự liệu không tồn tại";
            redirect("user/edit.php");
        }


        $data = 
            [
            'name'     => postInput('name'),
            'email'    => postInput('email'),
            'phone'    => postInput('phone'),
            'address'  => postInput('address')
        ];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $error = [];
        if (postInput('name') == '') 
        {
            $error['name'] = "Mới bạn nhập đầy đủ họ và tên";
        }
         if (postInput('email') == '') 
        {
            $error['email'] = "Mới bạn nhập email";
        }
        else
        {
            if (postInput('email') != $EditAdmin['email']) {
                $is_check = $db->fetchOne("users"," email = '".$data['email']."' ");
                if ($is_check != NULL) {
                    $error['email'] = "Email đã tồn tại!";
                }
            }
        } 

         if (postInput('phone') == '') 
        {
            $error['phone'] = "Mới bạn nhập số điện thoại";
        }

         if (postInput('address') == '') 
        {
            $error['address'] = "Mới bạn nhập địa chỉ";
        }
    
        if (postInput('password') != NULL && postInput('re_password') != NULL) {
            if ( postInput('password') != postInput('re_password')) {
               $error['password'] = "Mất khẩu thay đổi không khớp";
            }
            else
            {
                $data['password'] = MD5(postInput('password'));
            }
        }
        
         if (empty($error)) {
             $id_update = $db->update("users",$data,array('id'=>$id));
            if ($id_update>0) {
                echo "<script> alert('Mời bạn đăng nhập lại'); location.href='/tuanphuongphp/dang-nhap.php' </script>";
            }
            else{
                $_SESSION['error'] = "Cập nhật thất bại!";
                 redirect("user/edit.php");
            }
         }
        

    }
 ?>

<?php require_once __DIR__."/../layouts-user/header.php" //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
             Thêm mới admin
            </h1>
            <ol class="breadcrumb">
                 <li>
                    <i class="fa fa-dashboard"></i>  <a href="">Thông tin tài khoản</a>
                </li>
            </ol>
            <div class="clearfix"></div>
            <?php require_once __DIR__."/../partials/notification.php";?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Họ và tên</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Nguyễn Cương Quyết" value="<?php echo $EditAdmin['name'] ?>">
                        <?php if(isset($error['name'])):?>
                        <p class="text-danger"><?php echo $error['name'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="nguyencuongquyet96@gmail.com" value="<?php echo $EditAdmin['email'] ?>">
                        <?php if(isset($error['email'])):?>
                        <p class="text-danger"><?php echo $error['email'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" name="phone" placeholder="0942926840" value="<?php echo $EditAdmin['phone'] ?>">
                        <?php if(isset($error['phone'])):?>
                        <p class="text-danger"><?php echo $error['phone'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputEmail3" name="password" placeholder="********">
                        <?php if(isset($error['password'])):?>
                        <p class="text-danger"><?php echo $error['password'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Confirm Pass</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputEmail3" name="re_password" placeholder="********" >
                        <?php if(isset($error['re_password'])):?>
                        <p class="text-danger"><?php echo $error['re_password'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="address" placeholder="Thôn 3, Triệu Lăng, Triệu phong, Quảng trị" value="<?php echo $EditAdmin['address'] ?>">
                        <?php if(isset($error['address'])):?>
                        <p class="text-danger"><?php echo $error['address'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require_once __DIR__."/../layouts-user/footer.php"?>

             