<?php
	require_once __DIR__."/../../autoload/autoload.php";


   $id = intval(getInput('id'));
   $EditTransaction = $db->fetchID("transaction","$id");
   if (empty($EditTransaction)) {
   	  $_SESSION['error'] = "Dữ liệu không tồn tại";
   }

   if($EditTransaction['status']==1)
   {
   		$_SESSION['error'] = "Đơn hàng đã được xử lý";


   		redirectAdmin("transaction");
   }

   $status = 1;
   $update_tran = $db->update("transaction",array("status"=>$status),array("id"=>$id));


   if ($update_tran>0) {
   		$_SESSION['success'] = "Cập nhật thành công";
   		//lay cac  id_product va qty thuoc transaction tren cua bang order
   		$sqlpro = "SELECT product_id,qty FROM orders WHERE transaction_id = $id";
   		$Order = $db->fetchsql($sqlpro);

   		//mot vong lap tra ve mot mang product_id va qty cua transaction
   		foreach ($Order as $value) {
   			$idpro = intval($value['product_id']);
   			//lay thong tin cua product thong qua product_id
   			$product = $db->fetchID("products",$idpro);
   			
   			$number = $product['number'] - $value['qty'];
   			$pay = $product['pay']+1;
   			$update_pro = $db->update("products",array("pay"=>$pay,"number"=>$number),array("id"=>$idpro));
   		}

   		redirectAdmin("transaction");
   }
   else
   {
   	 $_SESSION['success'] = "Cập nhật thất bại";
   		redirectAdmin("transaction");
   }
?>