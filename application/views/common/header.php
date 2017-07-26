<input type="hidden" id="ar" value=0 >
<div id="preloader"></div>
    <header class="header-area">
        <div class="head-top-area" style="padding-bottom: 20px;padding-top:20px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6" style="padding:0;">
                       	<a href="<?php echo func::loc_url()?>">
                        	<img src="<?php echo $head['head_logo']?>" style="height:70px;">
                       	</a>
                        <!-- /.End Of Logo -->
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 hidden-xs" style="padding:0;">
                    	<div class="col-md-3 col-sm-6" style="margin-top: 15px;">
                    		<div class="fix" style="width:100%;cursor:pointer;"
                    		<?php if($head['head_cd_link1']){
                    			echo 'onclick="window.open(\''.$head['head_cd_link1'].'\')"'; 
                    		}?>
                    		>
                                <div class="info-icon" style="color:#22A7F0;font-size:30px">
                                    <i class="icofont icofont-sand-clock"></i>
                                </div>
                                <div class="info-content" style="font-size:14px;font-weight:600">
                                    <span><?php echo $head['head_cd_title1']?><br>
                          			 还有 
                          			 <lable style="font-size:18px;color:#22A7F0;"><?php echo $head['head_cd_time1']?></lable> 
                          			 天</span>
                                </div>
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6" style="margin-top: 15px;">
                    		<div class="fix" style="width:100%;cursor:pointer;"
                    		<?php if($head['head_cd_link2']){
                    			echo 'onclick="window.open(\''.$head['head_cd_link2'].'\')"'; 
                    		}?>
                    		>
                                <div class="info-icon" style="color:#22A7F0;font-size:30px">
                                    <i class="icofont icofont-pencil-alt-5"></i>
                                </div>
                                <div class="info-content" style="font-size:14px;font-weight:600">
                                    <span><?php echo $head['head_cd_title2']?><br>
                          				 还有 
                          				 <lable style="font-size:18px;color:#22A7F0;"><?php echo $head['head_cd_time2']?></lable>
                          				  天</span>
                                </div>
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6" style="margin-top: 15px;">
                    		<div class="fix" style="width:100%">
                                <div class="info-icon" style="color:#22A7F0;font-size:30px">
                                    <i class="icofont icofont-cur-yen"></i>
                                </div>
                                <div class="info-content" style="font-size:14px;font-weight:600">
                                    <span>今日日元汇率<br>
                          			 CNY1=JPY<?php echo $head['rate']?></span>
                                </div>
                            </div>
                    	</div>
                    	<div class="col-md-3 col-sm-6" style="margin-top: 15px;">
                    		<div class="fix" style="width:100%">
                                <div class="info-icon" style="color:#22A7F0;font-size:30px">
                                    <i class="icofont icofont-social-qq"></i>
                                </div>
                                <div class="info-content" style="font-size:14px;font-weight:600">
                                    <span>
                                    	<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $head['head_qq1']?>&amp;site=qq&amp;menu=yes"><?php echo $head['head_qq_title1']?></a>
                                    <br>
                           				<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $head['head_qq2']?>&amp;site=qq&amp;menu=yes"><?php echo $head['head_qq_title2']?></a>
                           			</span>
                                </div>
                            </div>
                    	</div>
                    	
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of Top Head -->
        <div class="head-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="mainmenu-area">
                        <nav class="navigation-menus">
                            <ul class="mobile-menu nav navbar-nav">
                            	<!-- 首页 -->
                            	<li class="<?php echo $route['con']=='home'?'active':''?>">
                            		<a href="<?php echo func::loc_url()?>">首页</a>
                            	</li>
        						<?php foreach($menu as $k=>$v){ ?>
        								<li  <?php if($hight_light_menu == $v['menu_id']) echo 'class="active"'?>>
        									<a style="cursor:pointer">
        										<?php echo $v['menu_title']?>
        										<i class="hover-ind fa fa-caret-down" aria-hidden="true"></i>
        									</a>
        									<ul class="sub-menu">
        										<?php foreach($v['nav'] as $k2=>$v2){?>
	        											<li>
	        												<!-- 普通的导航内容 -->
	        												<?php if($v2['nav_type'] == 0){ ?>
		        												<a href="<?php echo func::loc_url().'nav/index/'.$v2['nav_id']?>">
		        													<?php echo $v2['nav_title']?>
		        												</a>
		        											<!-- 如果是特殊内容 跳转到指定模块 -->
	        												<?php }else if($v2['nav_type'] > 0){?>
	        													<a href="<?php echo func::loc_url().$const_nav[$v2['nav_type']]['url']?>">
		        													<?php echo $v2['nav_title']?>
		        												</a>
	        												<?php }?>
	        											</li>
        										<?php }?>
        									</ul>
        								</li>
        						<?php }?>
        						<?php if($video_setting['valid'] == 1){ ?>
        							<li class="<?php echo $route['con']=='video'?'active':''?>">
	                            		<a style="cursor:pointer">
	                            			<?php echo $video_setting['video_setting_menu_title']?>
	                            			<i class="hover-ind fa fa-caret-down" aria-hidden="true"></i>
	                            		</a>
                            			<ul class="sub-menu">
                            				<?php foreach($video_category_list as $k=>$v){?>
        											<li>
        												<a href="<?php echo func::loc_url().'video/index/'.$v['video_category_id']?>">
        													<?php echo $v['video_category_title']?>
        												</a>
	        										</li>
        										<?php }?>
                            			</ul>
	                            	</li>
        						<?php }?>        						
        						<!-- 联系我们
                            	<li class="<?php echo $route['con']=='contact'?'active':''?>">
                            		<a href="<?php echo func::loc_url().'contact'?>">联系我们</a>
                            	</li>
                            	 -->
                             </ul>
                        </nav>
                        <a href="<?php echo func::loc_url().'sign'?>" class="button button-hover quote-btn">咨询评估</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of Bottom Head -->
    </header>
    <!-- /.End Of Header -->