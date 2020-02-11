<?php
    $open = "admin";
	require_once __DIR__."/../../autoload/autoload.php";

        $data = 
            [
            'name'     => postInput('name'),
            'email'    => postInput('email'),
            'phone'    => postInput('phone'),
            'address'  => postInput('address'),
            'password' =>MD5(postInput('password')),
            'level'    =>postInput('level')
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
            $is_check = $db->fetchOne("admin"," email = '".$data['email']."' ");
            if ($is_check != NULL) {
                $error['email'] = "Email đã tồn tại!";
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
        
          if (postInput('password') == '') 
        {
            $error['password'] = "Mới bạn nhập password";
        }


         if (postInput('password') != postInput('re_password')) 
        {
            $error['password'] = "Mật khẩu không khớp mời bạn nhập lại";
        }

         if (empty($error)) {
             $id_insert = $db->insert("admin",$data);
            if ($id_insert) {
                $_SESSION['success'] = "Thêm mới thành công! ";
                redirectAdmin("admin");
                //move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)
            }
            else{
                $_SESSION['error'] = "Thêm mới thất bại!";
                 redirectAdmin("admin");
            }
         }
        

    }
 ?>

<?php require_once __DIR__."/../../layouts/header.php" //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
             Thêm mới admin
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin/">Dashboard</a>
                </li>
                 <li>
                    <i class="fa fa-dashboard"></i>  <a href="">Admin</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Thêm mới
                </li>
            </ol>
            <div class="clearfix"></div>
            <?php require_once __DIR__."/../../../partials/notification.php";?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Họ và tên</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Nguyễn Cương Quyết" value="<?php echo $data['name'] ?>">
                        <?php if(isset($error['name'])):?>
                        <p class="text-danger"><?php echo $error['name'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="nguyencuongquyet96@gmail.com" value="<?php echo $data['email'] ?>">
                        <?php if(isset($error['email'])):?>
                        <p class="text-danger"><?php echo $error['email'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" name="phone" placeholder="0942926840" value="<?php echo $data['phone'] ?>">
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
                        <input type="password" class="form-control" id="inputEmail3" name="re_password" placeholder="********" required="" >
                        <?php if(isset($error['re_password'])):?>
                        <p class="text-danger"><?php echo $error['re_password'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="address" placeholder="Thôn 3, Triệu Lăng, Triệu phong, Quảng trị" value="<?php echo $data['address'] ?>">
                        <?php if(isset($error['address'])):?>
                        <p class="text-danger"><?php echo $error['address'];?></p>
                    <?php endif?>    
                    </div>
                </div>
               <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-8">
                        <select class="form-control " name="level">
                           <option value="1" <?php echo isset($data['level']) && $data['level'] == 1 ? "selected = 'selected'" : '' ?>>CTV</option>
                           <option value="2" <?php echo isset($data['level']) && $data['level'] == 2 ? "selected = 'selected'" : '' ?>>Admin</option>
                        </select>
                        <?php if(isset($error['level'])):?>
                        <p class="text-danger"><?php echo $error['level'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require_once __DIR__."/../../layouts/footer.php"?>

             