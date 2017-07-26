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
                    	<?php foreach($school_list as $k=>$v){ ?>
                    		<div class="col-sm-4">
	                            <div class="single-work sin-news">
	                                <a class="work-thumb mb-35" href="<?php echo func::loc_url().'sch/show/'.$v['school_id']?>">
	                                    <img src="<?php echo $v['school_img']?>" alt="" style="height:105px;">
	                                    <div class="work-hover"></div>
	                                </a>
	                                <div class="work-excerp">
	                                    <a href="<?php echo func::loc_url().'sch/show/'.$v['school_id']?>">
	                                    	<h2><?php echo $v['school_title']?></h2>
	                                    </a>
	                                    <span class="news-date"><?php echo $v['school_sub_title']?></span>
	                                </div>
	                            </div>
	                        </div>
                    	<?php }?>
						<!-- Single Work
                        <div class="col-sm-4">
                            <div class="single-work sin-news">
                                <a class="work-thumb mb-35" href="single-news.html">
                                    <img src="img/news/img-01.jpg" alt="">
                                    <div class="work-hover"></div>
                                </a>
                                <div class="work-excerp">
                                    <a href="single-news.html"><h2>Make your website more fast</h2></a>
                                    <span class="news-date">23rd March, 2016</span>
                                </div>
                            </div>
                        </div>
                        End Of Single Work -->
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

