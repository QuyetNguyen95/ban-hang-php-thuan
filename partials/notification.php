<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $_SESSION['success']; unset($_SESSION['success'])?>
    </div>
<?php endif?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
<?php endif?>