<?php
	require_once __DIR__."/autoload/autoload.php";
    $data = $db->fetchID("users",intval($_SESSION['id']));
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	 $data1 = [
    	'amount'  => $_SESSION['total'],	
    	'note'    => postInput('note'),
    	'user_id' => $_SESSION['id']
    ];

    $idtran = $db->insert("transaction",$data1);
    if ($idtran>0) {
    	foreach ($_SESSION['cart'] as $key => $value) {
    	$data2 = [
			'transaction_id' => $idtran,
			'product_id'     => $key,
			'qty' => $value['qty'],
			'price' => $value['price']
    	];
    	$idorder = $db->insert("orders",$data2);
    }
    }
    	unset($_SESSION['cart']);
  		unset($_SESSION['total']);
    	$_SESSION['success'] = "Lưu thông tin đơn hàng thành công1 Chúng tôi sẽ liên hệ với bạn sớm nhất";
    	header("location: thong-bao.php");
    	var_dump($_SESSION['cart']);die;
    }

?>
<?php require_once __DIR__."/layouts/header.php";?>
<div class="col-md-9 bor">
    <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href="">Thanh toán</a> </h3>
            <div style="margin-top: 40px;">
            	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Họ và tên</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Nguyễn Cương Quyết" value="<?php echo $data['name'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="nguyencuongquyet96@gmail.com" value="<?php echo $data['email'] ?>" readonly> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="phone" placeholder="0942926840" value="<?php echo $data['phone'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="address" placeholder="Thôn 3, Triệu Lăng, Triệu phong, Quảng trị" value="<?php echo $data['address'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tổng tiền</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="address" placeholder="Thôn 3, Triệu Lăng, Triệu phong, Quảng trị" value="<?php echo formatNumber($_SESSION['total']);?>" readonly>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="note" placeholder="note">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success" >Thanh toán</button>
                    </div>
                </div>
            </form>
            </div>
</div>
<?php require_once __DIR__."/layouts/footer.php";