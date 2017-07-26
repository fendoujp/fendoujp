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
                    		<?php if($type=='intro') echo consts::SCH_INTRO ;
                    			  else if($type =='enrol') echo consts::SCH_ENROL ;
                    			  else echo consts::SCH_ENVMT;
                    		?>
                    	</h4>
                    	<hr />
                    	<!-- Single News Post -->
		                <div class="sin-news-content">
		                <?php //学校介绍和招生介绍?>
		                <?php if($type != 'envmt'){ ?>
		                    <?php foreach($school_module as $k=>$v){ ?>
		                    	<?php if($v > 0){ ?>
			                    	<?php if($module[$v]['module_type'] == 1){ ?>
			                    		<div class="news-content">
			                    			<p><?php echo $module[$v]['module_content']?></p>
			                    		</div>
			                    	<?php }else if($module[$v]['module_type'] == 2){ ?>
			                    		<?php if($module[$v]['module_img_type'] == 0){?>
			                    		<div class="sin-news-thumb">
					                        <img src="<?php echo $module[$v]['module_img']?>" alt="">
					                    </div>
					                    <?php }else{?>
					                    <div class="sin-news-thumb" style="width:50%;float:left">
					                        <img src="<?php echo $module[$v]['module_img']?>" alt="">
					                    </div>
					                    <?php }?>
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
		               <?php //环境介绍 ?>
		               <?php }else{ ?>
		               		<?php foreach($school_module as $k=>$v){ ?>
		               			<?php if($v > 0 && $module[$v]['module_type'] == 2){ ?>
		               			<div class="col-md-4 col-sm-6">
				                    <div class="single-work text-center sin-project" style="margin-top:0">
				                        <a class="work-thumb mb-35 light-box" href="<?php echo $module[$v]['module_img']?>">
				                            <img src="<?php echo $module[$v]['module_img']?>" alt=""
				                            style="border:1px solid #ececec;height:185px;">
				                            <div class="works-hover"></div>
				                        </a>				                        
				                    </div>
				                </div>
				                <?php }?>
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

