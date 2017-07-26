<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'common/head.php'; ?>
<body>
<?php include VIEWPATH.'common/header.php'; ?>
<!-- content start -->

	<?php include VIEWPATH.'common/page_title.php'; ?>
	
    
    <div class="contact-area" style="margin-top:20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    		
                        <div class="contact-form">
                            <div class="single-form">
                                <div class="sin-input">
                                    <input type="text" id="name" placeholder="姓名">
                                </div>
                                <div class="sin-input">
                                    <input type="email" id="email" placeholder="邮箱">
                                </div>
                            </div>
                            <div class="single-form">
                            <div class="sin-input select-box">
                                    <select id="contact_type">
                                        <option value="">请选择联系方式</option>
                                        <option value="微信">微信</option>
                                        <option value="QQ">QQ</option>
                                        <option value="手机">手机</option>
                                    </select>
                                </div>
                                <div class="sin-input">
                                    <input type="text" id="contact_info" placeholder="联系方式">
                                </div>
                                
                            </div>
                            <div class="single-form">
                                <div class="sin-input select-box select-topic">
                                    <select id="topic">
                                        <option value="">我们能为您做些什么?</option>
                                        <option value="留学咨询">留学咨询</option>
                                        <option value="商务合作">商务合作</option>
                                        <option value="其他">其他</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-form text-area">
                                <textarea id="message" rows="5" placeholder="请输入您想说的话..."></textarea>
                                <input type="submit" id="submit" value="提 交 留 言" style="font-size:14px;font-weight:400">                              	
                            </div>
                        </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="quote-thumb">
                        <img style="max-height:360px" src="<?php echo func::res_url()?>assets/front/img/contact.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- content end -->	
<?php include VIEWPATH.'common/footer.php'?>

<?php include VIEWPATH.'common/foot.php'?>
</body>
<?php include JSPATH.$route['con'].DIR.$route['fun'].'.php'?>
</html>

