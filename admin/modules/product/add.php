<?php
    $open = "product";
	require_once __DIR__."/../../autoload/autoload.php";
    //lay ra danh muc san pham
    $category = $db->fetchAll("category");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $data = 
            [
            'name'        => postInput('name'),
            'slug'        => to_slug(postInput('name')),
            'category_id' => postInput('category_id'),
            'price'       => postInput('price'),
            'number'      =>postInput('number'),
            'content'     =>postInput('content'),
            'sale'        => postInput('sale')
        ];
        $error = [];
        if (postInput('name') == '') 
        {
            $error['name'] = "Mới bạn nhập đầy đủ tên sản phẩm";
        }
         if (postInput('category_id') == '') 
        {
            $error['category_id'] = "Mới bạn nhập danh mục sản phẩm";
        }

         if (postInput('price') == '') 
        {
            $error['price'] = "Mới bạn nhập giá  sản phẩm";
        }

         if (postInput('number') == '') 
        {
            $error['number'] = "Mới bạn nhập số lượng sản phẩm";
        }
         if (postInput('content') == '') 
        {
            $error['content'] = "Mới bạn nhập nội dung sản phẩm";
        }
        
        if ((int)$_FILES['image']['size'] == 0) {
            $error['image'] = "Mới bạn chọn hình ảnh";
        }
        //error trống nghĩa là không có lỗi
        if (empty($error)) {

            //xu ly image
            if (isset($_FILES['image'])) {
                $file_name  = $_FILES['image']['name'];
                $file_tmp   = $_FILES['image']['tmp_name'];
                $file_type  = $_FILES['image']['type'];// khong dung den
                $file_error = $_FILES['image']['error'];

                if ($file_error == 0) {
                    $part = ROOT . 'product/';
                    $data['image'] = $file_name;
                    //$target_file = $part. $file_name;
                }
            }


           $id_insert = $db->insert("products",$data);
                if ($id_insert) {
                    move_uploaded_file($file_tmp,$part.$file_name);
                    $_SESSION['success'] = "Thêm mới thành công! ";
                    redirectAdmin("product");
                    //move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)
                }
                else{
                    $_SESSION['error'] = "Thêm mới thất bại!";
                     redirectAdmin("product");
                }
        }

    }
 ?>

<?php require_once __DIR__."/../../layouts/header.php" //__DIR__Đường dẫn thư mục hiện tại.?>
                    <!-- Page Heading nội dung -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
             Thêm mới sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin/">Dashboard</a>
                </li>
                 <li>
                    <i class="fa fa-dashboard"></i>  <a href="">Sản phẩm</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Thêm mới
                </li>
            </ol>
            <div class="clearfix"></div>
            <?php require_once __DIR__."/../../../partials/notification.php";?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục Sp</label>
                    <div class="col-sm-8">
                        <select class="form-control " name="category_id">
                           <option value=""> -Mời bạn chọn danh mục sản phẩm- </option> 
                           <?php foreach ($category as $value): ?>
                               <option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
                           <?php endforeach ?>
                        </select>
                        <?php if(isset($error['category_id'])):?>
                        <p class="text-danger"><?php echo $error['category_id'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Tên sản phẩm">
                        <?php if(isset($error['name'])):?>
                        <p class="text-danger"><?php echo $error['name'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" name="price" placeholder="5.00000">
                        <?php if(isset($error['price'])):?>
                        <p class="text-danger"><?php echo $error['price'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" name="number" placeholder="0">
                        <?php if(isset($error['number'])):?>
                        <p class="text-danger"><?php echo $error['number'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputEmail3" name="sale" placeholder=" 2 %" value="0">
                    </div>
                    <label for="inputEmail3" class="col-sm-1 control-label">Hình ảnh</label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" id="inputEmail3" name="image" >
                        <?php if(isset($error['image'])):?>
                        <p class="text-danger"><?php echo $error['image'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-8">
                         <textarea name="content" id="content" rows="10" cols="80"></textarea>
                        <?php if(isset($error['content'])):?>
                        <p class="text-danger"><?php echo $error['content'];?></p>
                    <?php endif?>    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require_once __DIR__."/../../layouts/footer.php"?>


             