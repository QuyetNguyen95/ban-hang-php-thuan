<?php
    $open = "sp-da-mua";
	require_once __DIR__."/../autoload/autoload.php";
    

 ?>

<?php require_once __DIR__."/../layouts-user/header.php"; //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Danh sách sản phẩm
            </h1>
            <ol class="breadcrumb">
                
                <li class="active">
                    <i class="fa fa-file"></i> Đơn hàng của bạn
                </li>
            </ol>
            <div class="clearfix"></div>
           <!--  Thông báo lỗi -->
           <?php require_once __DIR__."/../partials/notification.php";?>
        </div>
    </div>
    <!-- /.row -->
   <!-- <div class="row">
       <div class="col-md-12">
           <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                          <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $stt =1; foreach ($order as  $value): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name']?></td>
                            <td><img src="<?php echo uploads(); ?>product/<?php echo $value['image'] ?>" alt="no image" width="80px" height="80px"></td>
                            <td>
                                    <li>Giá: <?php echo number_format($value['price'],0,".","."); ?> VNĐ</li>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
            </div>
       </div>
   </div> -->
<?php require_once __DIR__."/../layouts-user/footer.php"?>

             