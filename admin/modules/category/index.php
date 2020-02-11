<?php
    $open = "category";
	require_once __DIR__."/../../autoload/autoload.php";
	$category = $db->fetchAll("category");
	
 ?>

<?php require_once __DIR__."/../../layouts/header.php"; //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Danh sách danh mục
               <a href="<?php echo modules("category/add.php")?>" class="btn btn-success">Thêm mới</a>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin/">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Danh mục
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
                            <th>Slug</th>
                            <th>Home</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $stt =1; foreach ($category as  $value): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['slug']?></td>
                            <td>
                                <a href="home.php?id=<?php echo $value['id'] ?>" class="btn btn-xs <?php echo $value['home'] == 1 ? 'btn-info':'btn-default' ?>">
                                    <?php echo $value['home'] == 1 ? 'Hiển thị' : 'Không' ?>
                                </a>
                            </td>
                            <td><?php echo $value['created_at']?></td>
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
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
   </div>
<?php require_once __DIR__."/../../layouts/footer.php"?>

             