<!DOCTYPE html>
<html>
    <head>
        <title>MaxShop : Đồ án tốt nghiệp</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/bootstrap.min.css">
        
        <script  src="<?php echo base_url()?>public/frontend/js/jquery-3.2.1.min.js"></script>
        <script  src="<?php echo base_url()?>public/frontend/js/bootstrap.min.js"></script>
        <!---->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/style.css">
        
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <div id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-6" id="header-text">
                                <a>QuyetNguyen</a><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </b>
                            </div>
                            <div class="col-md-6">
                                <nav id="header-nav-top">
                                    <ul class="list-inline pull-right" id="headermenu">
                                        <?php if (isset($_SESSION['name'])): ?>
                                             <li>
                                                <a href="dang-nhap.php" style="color: red;">Xin chào: <?php echo $_SESSION['name'];?></a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fa fa-user"></i> Tài khoản của bạn <i class="fa fa-caret-down"></i></a>
                                                <ul id="header-submenu" style="margin-top: 36px;margin-left: -115px;width: 124px;">
                                                    <li><a href="user/edit.php">Thông tin</a></li>
                                                    <li><a href="gio-hang.php">Giỏ hàng</a></li>
                                                    <li><a href="thoat.php"><i class="fa fa-share-square-o"></i>Thoát</a></li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="dang-nhap.php"><i class="fa fa-unlock"></i> Đăng nhập</a>
                                            </li>
                                            <li>
                                                <a href="dang-ky.php"><i class="fa fa-unlock"></i> Đăng ký</a>
                                            </li>
                                        <?php endif ?>
                                        
                                        
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row " id="header-main">
                        <div class="col-md-4 ">
                            <a href="">
                                <img src="<?php echo base_url() ?>public/frontend/images/logo-default.png">
                            </a>
                        </div>
                        <div class="col-md-3 col-md-offset-5" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-phone-alt"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">HOTLINE</p>
                                    <p>0986420994</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END HEADER-->


            <!--MENUNAV-->
            <div id="menunav">
                <div class="container">
                    <nav>
                        <div class="home pull-left">
                            <a href="index.php">Trang chủ</a>
                        </div>
                        <!--menu main-->
                        <ul id="menu-main">
                            <li>
                                <a href="">Sản phẩm</a>
                            </li>
                            <li>
                                <a href="">Tin tức</a>
                            </li>
                            <li>
                                <a href="">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="">Liên hệ</a>
                            </li>
                        </ul>
                        <!-- end menu main-->

                        <!--Shopping-->
                        <ul class="pull-right" id="main-shopping">
                            <li>
                                <a href=""><i class="fa fa-shopping-basket"></i> My Cart </a>
                            </li>
                        </ul>
                        <!--end Shopping-->
                    </nav>
                </div>
            </div>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3  fixside" >
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                            <ul>
                                <?php foreach ($category1 as $value): ?>
                                    <li><a href="danh-muc-san-pham.php?id=<?php echo $value['id']?>"><?php echo $value['name']; ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                <?php foreach ($newProducts as $value): ?>
                                    <li class="clearfix">
                                    <a href="chi-tiet-san-pham.php?id=<?php echo $value['id']?>">
                                        <img src="<?php echo uploads()?>product/<?php echo $value['image']?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?php echo $value['name']; ?></p >
                                            <?php if ($value['sale']>0): ?>
                                                <b class="price">Giảm giá: <?php echo salePrice($value['price'],$value['sale'])?> đ</b><br>
                                                <b class="sale">Giá gốc: <?php echo formatNumber($value['price']);?> đ</b><br>
                                            <?php else: ?>
                                                <b class="price">Giá chỉ: <?php echo formatNumber($value['price']);?> đ</b><br>
                                            <?php endif ?>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm bán chạy </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                <?php foreach ($hotProducts as $value): ?>
                                    <li class="clearfix">
                                    <a href="chi-tiet-san-pham.php?id=<?php echo $value['id']?>">
                                        <img src="<?php echo uploads()?>product/<?php echo $value['image']?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> <?php echo $value['name']; ?></p >
                                             <?php if ($value['sale']>0): ?>
                                                <b class="price">Giảm giá: <?php echo salePrice($value['price'],$value['sale'])?> đ</b><br>
                                                <b class="sale">Giá gốc: <?php echo formatNumber($value['price']);?> đ</b><br>
                                            <?php else: ?>
                                                <b class="price">Giá chỉ: <?php echo formatNumber($value['price']);?> đ</b><br>
                                            <?php endif ?>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>
         