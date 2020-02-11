<?php
    $open = "product";
	require_once __DIR__."/../../autoload/autoload.php";

	if (isset($_GET['page'])) {
         $p = $_GET['page'];
    }
    else
    {
        $p =1;
    }


        $sql = "SELECT products.*,category.name as namecate FROM products LEFT JOIN category ON category.id = products.category_id";

        $product = $db->fetchJone('products',$sql,$p,2,true);
        if (isset($product['page'])) {
            $sotrang = $product['page'];
            unset($product['page']);
        }
 ?>

<?php require_once __DIR__."/../../layouts/header.php"; //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Danh sách sản phẩm
               <a href="<?php echo modules("product/add.php")?>" class="btn btn-success">Thêm mới</a>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin/">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Sản phẩm
                </li>
            </ol>
            <div class="clearfix"></div>
           <!--  Thông báo lỗi -->
           <?php require_once __DIR__."/../../../partials/notification.php";?>
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
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $stt =1; foreach ($product as  $value): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['namecate']?></td>
                            <td><?php echo $value['slug']?></td>
                            <td><img src="<?php echo uploads(); ?>product/<?php echo $value['image'] ?>" alt="no image" width="80px" height="80px"></td>
                            <td>
                                <ul>
                                    <li>Giá: <?php echo number_format($value['price'],0,".","."); ?> VNĐ</li>
                                    <li>Số lượng: <?php echo $value['number']; ?></li>
                                </ul>
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $value['id']?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>Sửa</a>
                                <a href="delete.php?id=<?php echo $value['id']?>" class="bnt btn-xs btn-danger"><i class="fa fa-times"></i>Xóa</a>
                            </td>
                        </tr>
                        <?php $stt++; endforeach ?>
                    </tbody>
                </table>
            </div>
       </div>
   </div>
   <div class="pull-right">
       <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i=1; $i <= $sotrang ; $i++):?>
                    <?php
                        if (isset($_GET['page'])) {
                            $p = $_GET['page'];
                        }
                        else
                        {
                            $p = 1;
                        }    
                    ?>
                    <li class="<?php echo ($i==$p) ? 'active' : ''?>">
                        <a href="?page=<?php echo $i?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor?>    
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
   </div>
<?php require_once __DIR__."/../../layouts/footer.php"?>

             