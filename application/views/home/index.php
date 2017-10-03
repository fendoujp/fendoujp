<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'common/head.php'; ?>
<body>
	<?php include VIEWPATH.'common/header.php'; ?>
	<!-- TOP BANNER start -->
	<?php if($layout['layout_top_banner'] == 1){ ?>
    <section class="slider-area">
        <div class="Modern-Slider">
        	<?php foreach($top_banner as $k=>$v){ ?>
        	<!-- Item -->
            <div class="item" <?php echo $k==1? 'style="opacity: 0;"': '';?>>
                <div class="img-fill">
                    <img src="<?php echo $v['top_banner_img']?>" alt="">
                    <div class="slider-text overlay">
                        <div class="tb">
                            <div class="tbc">
                                <div class="container text-left rs-padding ">
                                    <div class="col-md-12">
                                    	<h1><?php echo $v['top_banner_big_content']?></h1>                                        
                                        <p><?php echo $v['top_banner_small_content']?></p>
                                        <!-- 原文 -->
                                        <!-- <h1>We make <br><span>Best Products</span><br>for people</h1>
                                        <p>Confused with complex templates? We are here to help you. Now create
                                            <br>your amazing website for your lovely company.</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Item -->
        	<?php }?>
        </div>
    </section>
    <?php }?>
	<!-- TOP BANNER end -->
    <!-- TOP INTRO start -->
    <?php if($layout['layout_top_intro'] == 1){ ?>
    <section class="about-area section-padding">
        <div class="container">
            <div class="col-md-4">
                <div class="about-left">
                	<h2 style="font-size:20px;"><?php echo $top_intro['top_intro_up1']?></h2>
                	<figure class="about-thumb">
                        <img src="<?php echo $top_intro['top_intro_up_img']?>" alt="" class="img-responsive">
                        <figcaption>
                            <?php echo $top_intro['top_intro_up2']?>
                        </figcaption>
                    </figure>
                	<!-- 原文 -->
                	<!-- 
                    <h2>We have more than <strong>20 years of experiences</strong> <br>
                      in Making Products</h2>
                    <figure class="about-thumb">
                        <img src="assets/front/img/child/factory/about-thumb.jpg" alt="" class="img-responsive">
                        <figcaption>
                            “Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.”
                        </figcaption>
                    </figure>
                     -->
                </div>
            </div>
            <div class="col-md-7 col-md-offset-1">
                <div class="about-quote">
                	<blockquote>                		
                        <?php echo $top_intro['top_intro_up3']?>
                        <?php if($top_intro['top_intro_up3_link']){ ?>
                        <a href="<?php echo $top_intro['top_intro_up3_link'] ?>" 
                        	class="link-out" target="__blank">......点我,深入了解</a>
                        <?php }?>
                    </blockquote>
                	<!-- 原文 -->
                	<!-- 
                    <blockquote>
                        Duis autem vel eum iriure dolor in hendrerit in vulputate <strong>velit esse molestie</strong> consequat, vel illum dolore eu feugiat nulla <a href="" class="link-out">facilisis at vero</a> eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                        <br>
                        <br> Mirum est notare quam littera gothica, quam nunc putamus parum claram, antepos uerit litterarum formas humanitatis per seacula quarta.
                    </blockquote>
                    -->
                </div>
            </div>
        </div>
    </section>    
    <!-- Facts Area
        =========================== -->
    <section class="facts-area section-padding overlay fix" style="background-image:url('<?php echo $top_intro['top_intro_down_img']?>')">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="facts-headding">
                    <h2><?php echo $top_intro['top_intro_down1']?></h2>
                    <!-- 
                        <h2><strong>Best</strong> Facts of our company</h2>
                     -->
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <div class="fact-quote">
                    	<blockquote  style="font-size:20px;font-weight:600">
                    		<?php echo $top_intro['top_intro_down2']?>
                    	</blockquote>
                    	<!-- 
                        <blockquote>
                            Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer.
                        </blockquote>
                         -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="facts-wrap fix">
                    	<!-- 数字动画 -->
                    	<?php for($i=0;$i<5;$i++){ ?>
                    		<?php //这里 如果没有数字或者没有下面的解释 就不显示了?>
                    		<?php if(!$top_intro['top_intro_ani']['ani_'.$i.'_0'] || !$top_intro['top_intro_ani']['ani_'.$i.'_2']) {
                    					continue;
                    			}else{	
                    		?>
                    			<div class="sin-fact">
		                            <span class="counter"><?php echo $top_intro['top_intro_ani']['ani_'.$i.'_0']?></span>
		                            <span><?php echo $top_intro['top_intro_ani']['ani_'.$i.'_1']?></span>
		                            <h2 class="count-badge"><?php echo $top_intro['top_intro_ani']['ani_'.$i.'_2']?></h2>
		                        </div>
                    		<?php }?>
                    	<?php }?>
                    	<!-- 
                    	<div class="sin-fact">
                            <span class="counter">100</span><span>%</span>
                            <h2 class="count-badge">satisfiction rate</h2>
                        </div>
                    	 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.End Of Facts Area -->
	<!-- TOP INTRO end -->
	<?php }?>
	
    <!-- SCHOOL　ＣＡＴＥＧＯＲＹ 　　ｓｔａｒｔ　-->
    <?php if($layout['layout_school_category'] == 1){ ?>
    <section class="works-area section-padding">
        <div class="container">
        	<?php //如果输入了标题 则显示  否则部显示此部分?>
        	<?php if($layout['layout_school_category_title']){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>
	                        <a href="<?php echo func::loc_url()?>sch">
	                        <?php echo $layout['layout_school_category_title']?>
	                        </a>
                        </h2>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="row">
            	<?php foreach($school_category as $k=>$v){ ?>
	            	<div class="col-md-4 col-sm-6">
	                    <div class="single-work">
	                    	<input type="hidden" class="pre_load_img" value="<?php echo $v['school_category_cover_img']?>" />
	                        <a class="work-thumb mb-35" href="<?php echo func::loc_url().'sch/cate/'.$v['school_category_id']?>">
	                            <img src="<?php echo $v['school_category_img']?>" 
	                            data-img="<?php echo $v['school_category_img']?>" 
	                            data-cover-img="<?php echo $v['school_category_cover_img']?>" 
	                            class="school_category_img">
	                        </a>
	                        <div class="work-excerp">	                        	
	                            <h2>
	                            	<a href="<?php echo func::loc_url().'sch/cate/'.$v['school_category_id']?>">
	                           			<?php echo $v['school_category_name']?>
	                            	</a>
	                            </h2>
	                            <p><?php echo $v['school_category_content']?></p>
	                        </div>
	                    </div>
	                </div>
            	<?php }?>
                <!-- 原文 -->
                <!-- 
                <div class="col-md-4 col-sm-6">
                    <div class="single-work">
                        <a class="work-thumb mb-35" href="">
                            <img src="assets/front/img/child/factory/works/img-01.jpg" alt="">
                            <div class="work-hover"></div>
                        </a>
                        <div class="work-excerp">
                            <a href=""><h2>Best Renovation</h2></a>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulpu tate velit esse molestie consequat.</p>
                        </div>
                    </div>
                </div>
                 -->
            </div>
        </div>
    </section>
    <?php }?>
    <!-- SCHOOL　ＣＡＴＥＧＯＲＹ 　　ｅｎｄ　-->
   
    <!-- APPLY INTRO start -->
    <?php if($layout['layout_apply_intro'] == 1){ ?>
    <section class="info-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="info-thumbs fix" style="text-align:center">
                    	<h2>
	                        <a href="<?php echo func::loc_url()?>intro">
	                        	<?php echo $apply_intro['apply_intro_name']?>
	                        </a>
                        </h2>
                    	<div class="large-thumb thumbs">
                    		<a href="<?php echo func::loc_url()?>intro">
                            <img src="<?php echo $apply_intro['apply_intro_img'] ?>">
                            </a>
                        </div>
                    
                        <!-- 
                        <div class="large-thumb thumbs">
                            <img src="<?php echo func::res_url()?>assets/front/img/child/factory/info/img-01.jpg" alt="">
                        </div>
                        <div class="small-thumbs thumbs">
                            <img src="<?php echo func::res_url()?>assets/front/img/child/factory/info/img-02.jpg" alt="">
                            <img src="<?php echo func::res_url()?>assets/front/img/child/factory/info/img-03.jpg" alt="">
                        </div>
                         -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-text height-right">
                        <p><?php echo $apply_intro['apply_intro_content']?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php }?>
    <!-- APPLY INTRO end -->

    <!-- APPLY CONDITION  start -->
    <?php if($layout['layout_apply_condition'] == 1){ ?>
    <section class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="cta-text">
                        <h2><?php echo $apply_condition['apply_condition_name']?></h2>
                        <span><?php echo $apply_condition['apply_condition_content']?></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="cta-right">
                        <a href="<?php echo func::loc_url()?>condi" class="button button-hover button-cta"><?php echo $apply_condition['apply_condition_button']?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php }?>
    <!-- APPLY CONDITION  end -->

    <!-- EＸＰ　ＳＨＡＲＥ -->
    <?php if($layout['layout_exp_share'] == 1){?>
    <section class="tesimonial-area section-padding" style="padding-bottom:0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center mb-65">
                    	<?php //如果没有标题 就不显示标题?>
                    	<?php if($layout['layout_exp_share_title']){?>                        
                        <h2><a href="<?php echo func::loc_url()?>exp">
                        <?php echo $layout['layout_exp_share_title']?>
                        </a></h2>
                        
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="row mb-70">
                <div class="testimonial-wrap testimonial-active">
					<?php foreach($exp_share as $k=>$v){ ?>
						<div class="sin-tesimonial" >
	                        <span class="quote"><?php echo $v['exp_share_content']?>
	                        <a href="<?php echo func::loc_url().'exp/show/'.$v['exp_share_id']?>">...MORE
	                        </a>
	                        </span>	                        
	                        <a href="<?php echo func::loc_url().'exp/show/'.$v['exp_share_id']?>">
	                        <div class="cliet-bio">
	                            <h2><?php echo $v['exp_share_name']?></h2>
	                            <span class="client-pos"><?php echo $v['exp_share_note']?></span>
	                        </div>
	                        </a>
	                        
	                    </div>
					<?php }?>
                    <!-- Single Testimonial 
                    <div class="sin-tesimonial">
                        <span class="quote">Claritas est etiam processus dynamicus, qui
                        sequitur mutationem consuetudium lectorum.Mirum est notare quam littera
                        gothica, quam nunc putamus parum claram.</span>

                        <div class="cliet-bio">
                            <h2>Farhan Rizvi</h2>
                            <span class="client-pos">Product Designer</span>
                        </div>
                    </div>
                    /.End OfSingle Testimonial -->

                </div>
            </div>
            
        </div>
    </section>
    <?php }?>
    <!-- ＥＸＰ SHARE -->
    
    <!-- article　ＣＡＴＥＧＯＲＹ 　　ｓｔａｒｔ　-->
    <?php if($layout['layout_article_category'] == 1){ ?>
    <section class="works-area section-padding" style="border-bottom:1px solid #e3e3e3;">
        <div class="container">
        	<?php //如果输入了标题 则显示  否则部显示此部分?>
        	<?php if($layout['layout_article_category_title']){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>
                        	<a href="<?php echo func::loc_url()?>art">
                        	<?php echo $layout['layout_article_category_title']?>
                        	</a>
                        </h2>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="row">
            	<?php foreach($article_category as $k=>$v){ ?>
	            	<div class="col-md-4 col-sm-6">
	                    <div class="single-work">
	                        <a class="work-thumb mb-35" href="<?php echo func::loc_url().'art/cate/'.$v['article_category_id']?>">
	                            <img src="<?php echo $v['article_category_img']?>" alt="" style="/*height:190px*/">
	                        </a>
	                        <div class="work-excerp">
	                            <h2><?php echo $v['article_category_name']?></h2>
	                            <p><?php echo $v['article_category_content']?></p>
	                        </div>
	                    </div>
	                </div>
            	<?php }?>
                <!-- 原文 -->
                <!-- 
                <div class="col-md-4 col-sm-6">
                    <div class="single-work">
                        <a class="work-thumb mb-35" href="">
                            <img src="assets/front/img/child/factory/works/img-01.jpg" alt="">
                            <div class="work-hover"></div>
                        </a>
                        <div class="work-excerp">
                            <a href=""><h2>Best Renovation</h2></a>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulpu tate velit esse molestie consequat.</p>
                        </div>
                    </div>
                </div>
                 -->
            </div>
        </div>
    </section>
    <?php }?>
    <!-- article　ＣＡＴＥＧＯＲＹ 　　ｅｎｄ　-->
    
    <!-- BTM ADVERT　　ｓｔａｒｔ　-->
    <?php if($layout['layout_btm_advert'] == 1){ ?>
    <section class="works-area section-padding">
        <div class="container">
        	<?php //如果输入了标题 则显示  否则部显示此部分?>
        	<?php if($layout['layout_btm_advert_title']){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2><?php echo $layout['layout_btm_advert_title']?></h2>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="row">
            	<?php foreach($btm_advert as $k=>$v){ ?>
	            	<div class="col-md-4 col-sm-6">
	                    <div class="single-work">
	                        <a class="work-thumb mb-35" href="<?php echo $v['btm_advert_link']?>" target="__blank">
	                            <img src="<?php echo $v['btm_advert_img']?>" alt="" style="/*height:190px*/">
	                        </a>
	                        <div class="work-excerp">
	                            <h2><?php echo $v['btm_advert_name']?></h2>
	                            <p><?php echo $v['btm_advert_content']?></p>
	                        </div>
	                    </div>
	                </div>
            	<?php }?>
                <!-- 原文 -->
                <!-- 
                <div class="col-md-4 col-sm-6">
                    <div class="single-work">
                        <a class="work-thumb mb-35" href="">
                            <img src="assets/front/img/child/factory/works/img-01.jpg" alt="">
                            <div class="work-hover"></div>
                        </a>
                        <div class="work-excerp">
                            <a href=""><h2>Best Renovation</h2></a>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulpu tate velit esse molestie consequat.</p>
                        </div>
                    </div>
                </div>
                 -->
            </div>
        </div>
    </section>
    <?php }?>
    <!-- BTM ADVERT ｅｎｄ　-->
    		
	
    
    <!-- BTM MARQUEE start 新的滚动条，显示未分类的学校 -->
    <?php if($layout['layout_btm_marquee'] == 1){ ?>
    
    <section class="latestNews-area pb-140" style="padding:0px 80px 80px 80px;">
        <div class="container" >            
            <div class="row">
                <div class="clients-wrap clients-active" style="width:100%">
                <?php foreach($btm_school as $k=>$v){ ?>                	
                	<div class="sin-client" style="width:162px;height:74px;border:solid 2px #e3e3e3;padding:1px;">
                        <a href="<?php echo func::loc_url().'sch/show/'.$v['school_id']?>">
                        <img style="width:158px;height:68px;" src="<?php echo $v['school_img']?>" >
                        </a>
                    </div>        
                <?php }?>
                </div>
            </div>
        </div>
    </section>
    <?php }?>
    <!-- BTM MARQUEE end -->

<?php include VIEWPATH.'common/footer.php'?>

<?php include VIEWPATH.'common/foot.php'?>

<?php include JSPATH.$route['con'].DIR.$route['fun'].'.php'?>
</body>
</html>
