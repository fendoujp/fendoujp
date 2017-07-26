<!-- Widget -->
                    <div class="widget">
                    	<!-- 
                        <ul class="widget_links" 
                        style='background: rgba(0, 0, 0, 0) 
                        url("<?php echo func::res_url()?>assets/front/img/widget-bg.jpg") 
                        repeat scroll 0 0/cover;'>
                        -->
                        <ul class="widget_links">
                        	<?php foreach($sidebar as $k=>$v){ ?>
                        		<li><a href="<?php echo func::loc_url().$v['url']?>" 
                        			<?php if($v['select']) echo 'style="color:#f8cf27"'?> >
                        				<i class="fa fa-angle-right"></i><?php echo $v['text']?>
                        			</a>
                        		</li>
                        	<?php }?>
                        </ul>
                    </div>
<!-- /.End Of Widget -->