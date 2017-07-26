<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'common/head.php'; ?>
<body>
<?php include VIEWPATH.'common/header.php'; ?>
<!-- content start -->

	<?php  include VIEWPATH.'common/page_title.php'; ?>

    <!-- Page Internal Content -->
    <div class="page-internal-content">
        <div class="container">
            <div class="row">
                <aside class="col-md-3 sidebar">
                    <?php include VIEWPATH.'common/sidebar.php'?>
                </aside>

                <!-- Content Section -->
                <div class="col-md-9 main-content">
                    
                    	<h4 style="margin-left:20px">
                    		<?php echo $intro['intro_title'];
                    		?>
                    	</h4>
                    	<hr />
                    	<!-- Single News Post -->
		                <div class="sin-news-content">
		                    <?php foreach($intro_module as $k=>$v){ ?>
		                    	<?php if($v > 0){ ?>
			                    	<?php if($module[$v]['module_type'] == 1){ ?>
			                    		<div class="news-content">
			                    			<p><?php echo $module[$v]['module_content']?></p>
			                    		</div>
			                    	<?php }else if($module[$v]['module_type'] == 2){ ?>
			                    		<div class="sin-news-thumb">
					                        <img src="<?php echo $module[$v]['module_img']?>" alt="">
					                    </div>
			                    	<?php }else if($module[$v]['module_type']){?>
			                    		<div class="sin-news-thumb">
											<iframe class="video_iframe" style="<?php echo consts::VIDEO_PLAYER_STYLE?>" 
											src="http://v.qq.com/iframe/player.html?vid=<?php echo $module[$v]['module_content']?>&auto=0" >
											</iframe>
										</div>
			                    	<?php }?>
		                    	<?php }else{ ?>
		                    			<div style="height:20px;"></div>
		                    	<?php }?>	                    
		                    <?php }?>
		                    
		                    
		                    
		                   	<?php  include VIEWPATH.'common/next.php'?>
		                </div>
		                <!-- /.End Of Single News Post -->
                   
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

