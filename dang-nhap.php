<?php
	require_once __DIR__."/autoload/autoload.php";
   $data = [
        'email'    => postInput('email'),
        'password' => MD5(postInput('password')) 
   ];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = [];
        
        if (postInput('password') == '') {
             $error['password'] = "Xin mời nhập password";
        }
        if (postInput('email') == '') {
             $error['email'] = "Xin mời nhập email";
        }
       
       $is_check = $db->fetchOne("users","email = '".$data['email']."' AND "."password='".$data['password']."'");
       if ($is_check!= NULL) {
           $_SESSION['name'] = $is_check['name'];
           $_SESSION['id'] = $is_check['id'];
           echo "<script> alert('Đăng nhập thành công'); location.href='index.php' </script>";
       }
       else
       {
            $_SESSION['error'] = "Đăng nhập thất bại";
       }
    }
?>
<?php require_once __DIR__."/layouts/header.php";?>
<div class="col-md-9 bor">
    <section class="box-main1">
            <h3 class="title-main" style="text-align: left;"><a href="">Đăng nhập</a> </h3>
            <?php require_once __DIR__."/partials/notification.php";?>
            <div style="margin-top: 40px;">
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="nguyencuongquyet96@gmail.com" value="">
                        <?php if(isset($error['email'])):?>
                        <p class="text-danger"><?php echo $error['email'];?></p>
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Đăng nhập</button>
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