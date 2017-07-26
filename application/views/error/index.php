<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'common/head.php'; ?>
<body>
<?php include VIEWPATH.'common/header.php'; ?>
<!-- content start -->

	<section class="dissapp-content" style="padding:180px 15px">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center fix">
                    <h1 class="fourzerofour">404</h1>
                    <h2 class="error">Error</h2>
                    <h3 class="err-mess">we are not finding what you are looking for!</h3>
                    <h3 class="err-mess">非常抱歉~我们没有找到您需要的内容!</h3>
                    <span class="gohome"><a href="javascript:history.back(-1)">后退</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo func::loc_url()?>">返回首页</a></span>
                </div>
            </div>
        </div>
    </section>



<!-- content end -->	
<?php include VIEWPATH.'common/footer.php'?>

<?php include VIEWPATH.'common/foot.php'?>
</body>
</html>

