<?php
	require_once __DIR__."/autoload/autoload.php";
    if (isset($_SESSION['name'])) {
        echo "<script> alert('Bạn đã có tài khoản'); location.href='index.php' </script>";
    }
    $data = [
		'name'     => postInput('name'),
		'phone'    => postInput('phone'),
		'email'    => postInput('email'),
		'address'  => postInput('address'),
		'password' => MD5(postInput('password'))
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	$error = [];
    	if (postInput('name') == '') {
    		 $error['name'] = "Xin mời nhập tên";
    	}
    	if (postInput('password') == '') {
    		 $error['password'] = "Xin mời nhập password";
    	}
    	if (postInput('email') == '') {
    		 $error['email'] = "Xin mời nhập email";
    	}
        else
        {
            $is_check = $db->fetchOne("users","email ='".$data['email']."'");
            if ($is_check!= NULL) {
                 $error['email'] = "Email đã tồn tại xin mời nhập email khác ";
            }
        }    
    	if (postInput('address') == '') {
    		 $error['address'] = "Xin mời nhập địa chỉ";
    	}
    	if (postInput('phone') == '') {
    		 $error['phone'] = "Xin mời nhập số điện thoại";
    	}

    	if (empty($error)) {
    		$user_insert = $db->insert("users",$data);
    		if ($user_insert>0) {
                $_SESSION['success'] = "Đăng ký thành công! ";
               redirect("dang-nhap.php");
               
            }
            else{
               
            }
    	}
    }
?>
</script>
<?php require_once __DIR__."/layouts/header.php";?>
<div class="col-md-9 bor">
    <section class="box-main1">
            <h3 class="title-main" style="text-align: left;"><a href="">Đăng ký thành viên</a> </h3>
            <div style="margin-top: 40px;">
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
                        <input type="text" class="form-control" id="inputEmail3" name="phone" placeholder="0942926840" value="<?php echo $data['phone'] ?>">
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
                <!-- <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Confirm Pass</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputEmail3" name="re_password" placeholder="********" required="" >
                        <?php if(isset($error['re_password'])):?>
                        <p class="text-danger"><?php echo $error['re_password'];?></p>
                    <?php endif?>    
                    </div> -->
                <!-- </div> -->
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success" >Đăng ký</button>
                    </div>
                </div>
            </form>
            </div>
    </section>
</div>
<style type="text/css">
	.distance{
		margin-bottom: 40px;
	}
</style>
<?php require_once __DIR__."/layouts/footer.php";