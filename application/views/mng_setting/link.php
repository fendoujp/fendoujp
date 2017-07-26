<!DOCTYPE html>
<html lang="zh-cn">
  <?php include VIEWPATH.'mng_common/mng-head.php'; ?>
  <body>
      <div class="wrapper">
        <?php include VIEWPATH.'mng_common/mng-header.php'; ?>
        <!-- !header -->
        <div class="container">
          <div class="content box">
            <?php include VIEWPATH.'mng_common/mng-nav.php'; ?>            
            <div class="layer flex-1">
              <div class="location">
                <ul>
                  <li>位置</li>
                  <li>></li>
                  <li>设定</li>
                  <li>></li>
                  <li><?php echo $submenu['position']?></li>
                </ul>
              </div>
              <div class="main">
              	<?php echo $submenu['menu_html']?>
              	<hr>
                <div class="modal-content" style="margin-top:20px;">				      
				  <div class="form-horizontal">
					<div class="modal-body">
					  <div class="info-edit">
					  	<?php foreach($link as $k=>$v){ ?>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">链接名称：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="link_title_<?php echo$v['link_id']?>" 
							   placeholder="请填写标题" value="<?php echo $v['link_title']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">链接地址：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="link_url_<?php echo$v['link_id']?>" 
							   placeholder="请填写http://或者https://开头的网址" value="<?php echo $v['link_url']?>" >
							</div>							
						</div>
						<div class="form-group form-group-sm">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-7"  style="text-align:right">
						<button type="submit" data-id="<?php echo $v['link_id']?>"
						class="btn btn-primary btn-standard submit_button">提交修改</button>
						</div>
						</div>
						<hr />
						<?php }?>
							   
						
						
					  </div>            
					</div>
				  </div>
				  <!-- !modal-body -->
				</div> 
                
              </div>
              <!-- !main -->
            </div>
            <!-- !layer -->
          </div>
          <!-- !content -->
        </div>
        <!-- !container -->
        <?php include VIEWPATH.'mng_common/mng-footer.php'; ?>
      </div>
  </body>
<script>
ready(function(){

	$(".submit_button").each(function(){
		$(this).click(function(){
			var link_id = $(this).attr('data-id');
			var update = {};
			update.link_id = link_id;
			update.link_title = $("#link_title_"+link_id).val();
			update.link_url = $("#link_url_"+link_id).val();
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_setting/save_link',
		        data : update,
		        success : function(response) {
			    //错误处理
		          if(!errorMsg(response)) {
		            if(response == '1'){
						alert('保存成功');
						refresh();//刷新网页
		            }else{
						alert('保存失败');
		            }
		          }
		        }
		    });		
			
		});
	});
	
	
});
	
	
</script>
</html>