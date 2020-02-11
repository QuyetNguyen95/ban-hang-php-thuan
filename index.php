<?php
	require_once __DIR__."/autoload/autoload.php";
    //lay id va name cua category co gia tri home = 1
    $sqlCategory = "SELECT id, name FROM category WHERE home = 1 ORDER BY updated_at";
    $category = $db->fetchsql($sqlCategory);
    //tao mot mang data trong de chua dua lieu mang 2 chieu thong tin san pham cua 1 category
    $data = [];
    foreach ($category as  $value) {
        $cateID = intval($value['id']);
        //lay id cua category co home = 1
        $sqlProduct = "SELECT * FROM products WHERE category_id = $cateID";
        // lay tat ca cac san pham co category_id bang id cua category
        $product = $db->fetchsql($sqlProduct);
        $data[$value['name']] = $product;
        //tra ve mot mang 2 chieu
    }
?>
<?php require_once __DIR__."/layouts/header.php";?>
<div class="col-md-9 bor">
    <section id="slide" class="text-center" >
        <img src="<?php echo base_url()?>/public/frontend/images/slide/banner.jfif" class="img-thumbnail" width="850px" height="230px">
    </section>
    <section class="box-main1">
        <?php foreach ($data as $key => $value): ?>
            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"><?php echo $key; ?></a> </h3>
            <div class="showitem">
                <?php foreach ($value as $item): ?>
                    <div class="col-md-3 item-product bor">
                    <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>">
                        <img src="<?php echo uploads() ?>product/<?php echo $item['image'] ?>" class="" width="100%" height="180">
                    </a>
                    <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><?php echo $item['name']; ?></a>
                        <p><strike class="sale"><?php echo formatNumber($item['price']) ?> đ</strike> <b class="price"><?php echo salePrice($item['price'],$item['sale'])?> đ</b></p>
                    </div>
                    <div class="hidenitem">
                        <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><i class="fa fa-search"></i></a></p>
                        <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><i class="fa fa-heart"></i></a></p>
                        <p><a href="addcart.php?id=<?php echo $item['id']?>"><i class="fa fa-shopping-basket"></i></a></p>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    </section>

</div>
<?php require_once __DIR__."/layouts/footer.php";