<?php
    $open = "dashboard";
	require_once __DIR__."/autoload/autoload.php";
    //user

    $countUser = $db->countTable("users");

    //tong transaction
    $countTran = $db->countTable("transaction");

    //transaction chua xu ly

    $sqlNoTran = "SELECT id FROM transaction WHERE status = 0";
    $countNoTran = count($db->fetchsql($sqlNoTran));

    //order
   
    $countOder = $db->countTable("orders");

    //product

    $countPro = $db->countTable("products");
 ?>

<?php require_once __DIR__."/layouts/header.php" //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Xin chào bạn đến với trang quản trị của admin
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
   <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countUser; ?></div>
                        <div>Thành viên</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countNoTran ?>/<?php echo $countTran ?></div>
                        <div>Transaction</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countOder ?></div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countPro  ?></div>
                        <div>Sản phẩm</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Order Date</th>
                            <th>Order Time</th>
                            <th>Amount (USD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>3326</td>
                            <td>10/21/2013</td>
                            <td>3:29 PM</td>
                            <td>$321.33</td>
                        </tr>
                        <tr>
                            <td>3325</td>
                            <td>10/21/2013</td>
                            <td>3:20 PM</td>
                            <td>$234.34</td>
                        </tr>
                        <tr>
                            <td>3324</td>
                            <td>10/21/2013</td>
                            <td>3:03 PM</td>
                            <td>$724.17</td>
                        </tr>
                        <tr>
                            <td>3323</td>
                            <td>10/21/2013</td>
                            <td>3:00 PM</td>
                            <td>$23.71</td>
                        </tr>
                        <tr>
                            <td>3322</td>
                            <td>10/21/2013</td>
                            <td>2:49 PM</td>
                            <td>$8345.23</td>
                        </tr>
                        <tr>
                            <td>3321</td>
                            <td>10/21/2013</td>
                            <td>2:23 PM</td>
                            <td>$245.12</td>
                        </tr>
                        <tr>
                            <td>3320</td>
                            <td>10/21/2013</td>
                            <td>2:15 PM</td>
                            <td>$5663.54</td>
                        </tr>
                        <tr>
                            <td>3319</td>
                            <td>10/21/2013</td>
                            <td>2:13 PM</td>
                            <td>$943.45</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__."/layouts/footer.php"?>

             