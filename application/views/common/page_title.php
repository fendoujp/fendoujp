<?php if($page_title){ ?>
<!-- Page Title Area
      =========================== -->
    <section class="page-title fix">
        <div class="container bb-bottom">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-content">
                        <h2 class="page-title"><?php echo $page_title?></h2>
                        <span class="sub-title"><?php echo $page_sub_title == '' ? '文章列表':$page_sub_title;?></span>
                    </div>
                    <div class="bread-cumb">
                        <ul>
                            <li><a href="<?php echo func::loc_url() ?>">HOME</a></li>
                            <li><a href="<?php echo func::loc_url().$route['con']?>">RETURN</a></li>
                        </ul>
                    </div>
                    <!-- /.END OF BREAD CUMB -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Of Page Title Area -->
<?php }?>