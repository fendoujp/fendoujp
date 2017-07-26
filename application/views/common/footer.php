    <!-- Footer Area
        =========================== -->
    <footer id="footer-area">
        <div class="footer-top section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12" style="padding-right:30px;">
                        <div class="widget widget_text">
                            <div class="footer-logo">
                                <img src="<?php echo $foot['foot_logo']?>" style="max-height:34px;">
                            </div>
                            <p><?php echo $foot['foot_intro']?></p>
                            </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget widget_links fix">
                            <h3 class="widget-title">友情链接</h3>
                            <ul class="site_map_links" style="margin-right:20px;">
                            	<!-- 这边部分之输出前4个 -->
                            	<?php foreach($link as $k=>$v){ ?>
                            		<?php if($k>3) break;?>
                            		<?php if($v['link_title']){ ?>
                            			<li>
                            				<a <?php if($v['link_url']) echo 'href="'.$v['link_url'].'"'?> target="__blank">
                            					<?php echo $v['link_title']?>
                            				</a>
                            			</li>
                            		<?php }?>
                            	<?php }?>
                            </ul>
                            <ul class="page-links" style="padding-left:20px;">
                            	<!-- 这边部分之输出后4个 -->
                            	<?php foreach($link as $k=>$v){ ?>
                            		<?php if($k<4) continue;?>
                            		<?php if($v['link_title']){ ?>
                            			<li>
                            				<a <?php if($v['link_url']) echo 'href="'.$v['link_url'].'"'?> target="__blank">
                            					<?php echo $v['link_title']?>
                            				</a>
                            			</li>
                            		<?php }?>
                            	<?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget" >
                            <h3 class="widget-title">联系我们</h3>
                            <p><?php echo $foot['foot_contact']?>
                            </p>
                            <a href="<?php echo func::loc_url()?>contact" class="button contact-btn">联&nbsp;系&nbsp;我&nbsp;们</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget" style="margin-top:10px;">                     
                            <div class="widget" style="width:40%;float:left;font-size:12px;">
                                <img src="<?php echo $foot['foot_pt_img1']?>" />
                                <br /><br />
                            	<span><?php echo $foot['foot_pt_title1']?>:</span><br/>
                            	<span style="font-size:13px;"><?php echo $foot['foot_pt_content1']?></span>
                            	
                            	
                            </div>
                            <div class="widget" style="width:40%;float:left;font-size:12px;margin-left:10%">
                                <img src="<?php echo $foot['foot_pt_img2']?>" />
                                <br /><br />
                            	<span><?php echo $foot['foot_pt_title2']?>:</span><br/>
                            	<span style="font-size:13px;"><?php echo $foot['foot_pt_content2']?></span>
                            	
                            	
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom fix">
            <div class="container bb-top foo-padding">
                <div class="row">
                    <div class="col-sm-6 copyright">
                        <span>&copy; 2017 Copyright,  奋斗在日本留学网    www.fendoujp.com </span>
                    </div>
                    <div class="col-sm-6 text-right">
                        <div class="social-links">
                            <ul>
                                <li>Powered By 株式会社ストライブ  MyDivine</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.End Of Footer Area -->
    
    <div class="side-bar"> 
        <a target="_blank" class="icon-qq" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $head['head_qq2']?>&amp;site=qq&amp;menu=yes">QQ在线咨询</a>
		<a class="icon-chat" id="chat_tips_btn" style="cursor:pointer">微信<div class="chat-tips" id="chat_tips"><i></i><img style="width:138px;height:138px;max-width:none" src="<?php echo func::res_url()?>assets/default/qrcode.jpg" alt="微信订阅号"></div></a> 
		<a target="_blank" href="http://weibo.com/fendoujp" class="icon-blog">微博</a> 
		<!-- 
		<a class="icon-mail" style="cursor:pointer">mail</a> 
		 -->
	</div>