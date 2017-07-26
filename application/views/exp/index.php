<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'common/head.php'; ?>
<body>
<?php include VIEWPATH.'common/header.php'; ?>
<!-- content start -->

	<?php include VIEWPATH.'common/page_title.php'; ?>

    <!-- Page Internal Content -->
    <div class="page-internal-content">
        <div class="container">
            <div class="row">
                <aside class="col-md-3 sidebar">
                    <?php include VIEWPATH.'common/sidebar.php'?>
                </aside>

                <!-- Content Section -->
                <div class="col-md-9 main-content">
                
                    <div class="row">
                    <!-- 
                    	<?php foreach($exp_share_list as $k=>$v){ ?>
                    		<div class="col-sm-4">
	                            <div class="single-work sin-news">
	                                <a class="work-thumb mb-35" href="<?php echo func::loc_url().'exp/show/'.$v['exp_share_id']?>">
	                                    <img src="<?php echo $v['exp_share_img']?>" alt="">
	                                    <div class="work-hover"></div>
	                                </a>
	                                <div class="work-excerp">
	                                    <a href="<?php echo func::loc_url().'exp/show/'.$v['exp_share_id']?>">
	                                    	<h2><?php echo $v['exp_share_name']?></h2>
	                                    </a>
	                                    <span class="news-date"><?php echo $v['exp_share_note']?></span>
	                                </div>
	                            </div>
	                        </div>
                    	<?php }?>
					 -->
					 <?php foreach($exp_share_list as $k=>$v){ ?>
					 	<div class="col-md-6 ">
                            <ul class="degins">                          		
                                <li>
                                <a href="<?php echo func::loc_url().'exp/show/'.$v['exp_share_id']?>" >
                                	<?php echo $v['exp_share_name']?>
                                    <br>
                                    <span><?php echo $v['exp_share_note']?></span>
                                </a>
                                </li>                                
                            </ul>
                        </div>
                    <?php }?>	
					 
                        <?php  include VIEWPATH.'common/page.php'?>
                    </div>
                </div>
                <!-- /.End Of Content Section -->
            </div>
        </div>
    </div>
    <!-- /.End Of Page Internal Content -->



<!-- content end -->	
<?php include VIEWPATH.'common/footer.php'?>

<?php include VIEWPATH.'common/foot.php'?>
</body>
</html>

