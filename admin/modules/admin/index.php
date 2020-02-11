<?php
    $open = "admin";
	require_once __DIR__."/../../autoload/autoload.php";

	if (isset($_GET['page'])) {
         $p = $_GET['page'];
    }
    else
    {
        $p =1;
    }


        $sql = "SELECT * FROM admin ORDER BY  id DESC";

        $admin = $db->fetchJone('admin',$sql,$p,2,true);
        if (isset($admin['page'])) {
            $sotrang = $admin['page'];
            unset($admin['page']);
        }
 ?>

<?php require_once __DIR__."/../../layouts/header.php"; //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Danh sách Admin
               <a href="<?php echo modules("admin/add.php")?>" class="btn btn-success">Thêm mới</a>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin/">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Admin
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $stt =1; foreach ($admin as  $value): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['email']?></td>
                            <td><?php echo $value['phone']?></td>
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

             