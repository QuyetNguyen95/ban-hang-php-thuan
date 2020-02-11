<?php 
	require_once __DIR__."/autoload/autoload.php";
	$id = intval(getInput("id"));
	$danhmuc = $db->fetchID("category",$id);

	if (isset($_GET['p'])) {
         $p = $_GET['p'];
    }
    else
    {
        $p =1;
    }


        $sqlcate = "SELECT * FROM products WHERE category_id = $id";

        $total = count($db->fetchsql($sqlcate));
        $product = $db->fetchJones('products',$sqlcate,$total,$p,2,true);
        if (isset($product['page'])) {
            $sotrang = $product['page'];
            unset($product['page']);
        }
        $path = $_SERVER['SCRIPT_NAME']; 
        // var_dump($path); tra ve  '/tuanphuongphp/danh-muc-san-pham.php'
		
 ?>
 <?php require_once __DIR__."/layouts/header.php";?>
 	<div class="col-md-9 bor">
 		<section class="box-main1">
 			<h3 class="title-main"><a href=""> <?php echo $danhmuc['name']; ?></a></h3>
 			<div class="showitem clearfix">
                <?php foreach ($product as  $value): ?>
                	<div class="col-md-3 item-product bor">
                    <a href="chi-tiet-san-pham.php?id=<?php echo $value['id']?>">
                        <img src="<?php echo uploads()?>product/<?php echo $value['image']?>" class="" width="100%" height="180">
                    </a>
                    <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $value['id']?>"><?php echo $value['name']; ?></a>
                        <p><strike class="sale"><?php echo formatNumber($value['price']) ?> đ</strike> <b class="price"><?php echo salePrice($value['price'],$value['sale']) ?> đ</b></p>
                    </div>
                    <div class="hidenitem" style="display: none;">
                        <p><a href="chi-tiet-san-pham.php?id=<?php echo $value['id']?>"><i class="fa fa-search"></i></a></p>
                        <p><a href="chi-tiet-san-pham.php?id=<?php echo $value['id']?>"><i class="fa fa-heart"></i></a></p>
                        <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="pull-right">
       <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($i=1; $i <= $sotrang ; $i++):?>
                    
                    <li class="<?php echo ($i==$p) ? 'active' : ''?>">
                        <a href="<?php echo $path?>?id=<?php echo $id ?>&&p=<?php echo $i?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor?>    
            </ul>
        </nav>
   </div>
 		</section>
 	</div>
 <?php require_once __DIR__."/layouts/footer.php";?>