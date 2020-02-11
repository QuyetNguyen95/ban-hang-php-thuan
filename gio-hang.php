<?php	require_once __DIR__."/autoload/autoload.php";
	$sum = 0;
	if (! isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
		echo "<script> alert('Giỏ hàng trống'); location.href='index.php' </script>";
	}
?>
<?php require_once __DIR__."/layouts/header.php";?>
<div class="col-md-9">
    <section class="box-main1">
            <h3 class="title-main" style="text-align: left;"><a href="">Giỏ hàng</a> </h3>
             <?php require_once __DIR__."/partials/notification.php";?>
            <table class="table">
			    <thead>
			      <tr>
			        <th>STT</th>
			        <th>Tên sản phẩm</th>
			        <th>Hình ảnh</th>
			        <th>Số lượng</th>
			        <th>Giá</th>
			        <th>Tổng tiền</th>
			        <th>Tháo tác</th>
			      </tr>
			    </thead>
			    <tbody>
			    	
			      <?php $stt=1; foreach ($_SESSION['cart'] as $key => $value): ?>
			      	<tr>
				        <td><?php echo $stt;?></td>
				        <td><?php echo $value['name'] ?></td>
				        <td>
				        	<img src="<?php echo uploads()?>product/<?php echo $value['image'] ?>" width="80px"; height="80px";>
				        </td>
				        <td>
				        	<input type="number" name="qty" value="<?php echo $value['qty'] ?>" class="form-control qty" style="width: 70px" min="0" id = "qty">
				        </td>
				        <td><?php echo formatNumber($value['price']) ?></td>
				        <td><?php echo formatNumber($value['price']*$value['qty']) ?></td>
				        <td>
				        	<a href="remove.php?key=<?php echo $key ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove" style="color: white"></i>Xóa</a>
				        	<a href="#" class="btn btn-xs btn-info updatecart" data-key=<?php echo $key ?> ><i class="glyphicon glyphicon-ok" style="color: white"></i>Cập nhật</a>
				        </td>
				        <?php $sum +=$value['price']*$value['qty']; $_SESSION['tongtien'] = $sum ?>
			       </tr>
			      <?php $stt++; endforeach ?>
			    </tbody>
			 </table>
			 <div class="col-md-5 pull-right">
			 	<ul class="list-group">
				  <li class="list-group-item"><h3>Thông tin đơn hàng</h3></li>
				  <li class="list-group-item">
				  	<span class="badge"><?php echo formatNumber($_SESSION['tongtien']) ?></span>
				  Số tiền
				   </li>
				  <li class="list-group-item">
				  	<span class="badge">10 %</span>
				  Thuế VAT
				   </li>
				  <li class="list-group-item">
					<span class="badge">
					<?php $_SESSION['total'] =  $_SESSION['tongtien']*110/100; echo formatNumber($_SESSION['total']); ?></span>
				  	Tổng thanh toán</li>
				  <li class="list-group-item">
				  	 <a href="index.php" class="btn btn-success">Tiếp tục mua hàng</a>
				  	 <a href="thanh-toan.php" class="btn btn-success">Thanh toán</a>
				  </li>	
				</ul>
			 </div>
    </section>
</div>
<?php require_once __DIR__."/layouts/footer.php";