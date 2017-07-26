<div class="navigation">
	<ul>		  
		<li class="nav-item" data-name="mng_home">
			<i class="fa fa-home"></i> 
			<a href="<?php echo func::loc_url() ?>mng_home">首页管理</a>
		</li>                     
        <li class="nav-item" data-name="mng_nav">
        	<i class="fa fa-flag"></i>
        	<a href="<?php echo func::loc_url() ?>mng_nav">导航管理</a>
        </li>                        
		<li class="nav-item" data-name="mng_school">
			<i class="fa fa-bank"></i>
			<a href="<?php echo func::loc_url() ?>mng_school">学校介绍</a>
		</li>
		<li class="nav-item" data-name="mng_intro">
			<i class="fa fa-paper-plane"></i>
			<a href="<?php echo func::loc_url() ?>mng_intro">申请流程</a>
		</li>
		<li class="nav-item" data-name="mng_condi">
			<i class="fa fa-external-link-square"></i>
			<a href="<?php echo func::loc_url() ?>mng_condi">申请条件</a>
		</li>
		<li class="nav-item" data-name="mng_article">
			<i class="fa fa-file-text"></i>
			<a href="<?php echo func::loc_url() ?>mng_article">文章管理</a>
		</li>
		<li class="nav-item" data-name="mng_video">
			<i class="fa fa-video-camera"></i>
			<a href="<?php echo func::loc_url() ?>mng_video">视频管理</a>
		</li>
		<li class="nav-item" data-name="mng_contact">
        	<i class="fa fa-group"></i>
        	<a href="<?php echo func::loc_url() ?>mng_contact">在线留言</a>
        </li>   
        <li class="nav-item" data-name="mng_sign">
        	<i class="fa fa-file"></i>
        	<a href="<?php echo func::loc_url() ?>mng_sign">报名管理</a>
        </li>
        <li class="nav-item" data-name="mng_setting">
        	<i class="fa fa-cog"></i>
        	<a href="<?php echo func::loc_url() ?>mng_setting">设定</a>
        </li> 
        <li class="nav-item" data-name="mng_setti1ng">
        	<i class="fa fa-area-chart"></i>
        	<a href="<?php echo func::loc_url() ?>mng_set1ting">统计</a>
        </li>        
	</ul>
</div>
<!-- !navigation -->
<!-- navigation select -->
<script>$('li[data-name="<?php print_r($route['con'])?>"]').addClass('current')</script>