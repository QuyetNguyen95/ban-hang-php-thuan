<?php
    $open = "transaction";
	require_once __DIR__."/../../autoload/autoload.php";

	if (isset($_GET['page'])) {
         $p = $_GET['page'];
    }
    else
    {
        $p =1;
    }


        $sql = "SELECT transaction.* , users.name as username, users.phone as userphone FROM transaction LEFT JOIN users ON transaction.user_id = users.id ORDER BY id DESC";

        $transaction = $db->fetchJone('transaction',$sql,$p,2,true);
        if (isset($transaction['page'])) {
            $sotrang = $transaction['page'];
            unset($transaction['page']);
        }
 ?>

<?php require_once __DIR__."/../../layouts/header.php"; //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Danh sách Transaction
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin/">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Transaction
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
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $stt =1; foreach ($transaction as  $value): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['username']?></td>
                            <td><?php echo $value['userphone']?></td>
                            <td>
                                <a href="status.php?id=<?php echo $value['id'] ?>" class="btn btn-xs <?php echo $value['status'] == 0 ? 'btn-danger': 'btn-success'?>">
                                    <?php echo $value['status'] == 0 ? 'Chưa xử lý': 'Đã xử lý'?>    
                                </a>
                            </td>
                            <td>
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

             