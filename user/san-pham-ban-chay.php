<?php
    $open = "sp-ban-chay";
	require_once __DIR__."/../autoload/autoload.php";
    $sql = "SELECT * FROM products WHERE 1 ORDER BY pay DESC LIMIT 3";
    $hotProducts = $db->fetchsql($sql);
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
                    <i class="fa fa-file"></i> Sản phẩm bán chạy
                </li>
            </ol>
            <div class="clearfix"></div>
           <!--  Thông báo lỗi -->
           <?php require_once __DIR__."/../partials/notification.php";?>
        </div>
    </div>
    <!-- /.row -->
   <div class="row">
       <div class="col-md-12">
           <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                          <th>Info</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $stt =1; foreach ($hotProducts as  $value): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name']?></td>
                            <td><img src="<?php echo uploads(); ?>product/<?php echo $value['image'] ?>" alt="no image" width="80px" height="80px"></td>
                            <td>
                                <ul>
                                    <li>Giá: <?php echo number_format($value['price'],0,".","."); ?> VNĐ</li>
                                    <li>Số lượng: <?php echo $value['number']; ?></li>
                                </ul>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
            </div>
       </div>
   </div>
<?php require_once __DIR__."/../layouts-user/footer.php"?>

             