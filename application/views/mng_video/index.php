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
                  <li><?php echo $submenu['position']?></li>
                </ul>
              </div>
              <div class="main">
              	<?php echo $submenu['menu_html']?>
                <div class="modal-content" style="margin-top:20px;">
				  <div class="modal-header">
					<h4 class="modal-title">视频综合设置</h4>
				  </div>
				  <div class="form-horizontal">
					<div class="modal-body">
					  <div class="info-edit">
					  	<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">状态：</label>
							<div class="col-sm-7">
							   <input type="radio" <?php if($video_setting['valid'] == 1) echo 'checked'?>
							   value="1" name="valid">启用
							   
							   <input type="radio" <?php if($video_setting['valid'] == 0) echo 'checked'?>
							   style="margin-left:50px" value="0" name="valid">停用
							</div>
						</div>
					  
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">导航栏题目：</label>
							<div class="col-sm-7">
							   <input class="form-control" 
							   value="<?php echo $video_setting['video_setting_menu_title']?>"
							   id="video_setting_menu_title" placeholder="导航栏标题" >
							</div>
						</div>
						
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">内页标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" 
							   value="<?php echo $video_setting['video_setting_page_title']?>"
							   id="video_setting_page_title" placeholder="内页标题" >
							</div>
						</div>
						
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">内页副标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" 
							   value="<?php echo $video_setting['video_setting_page_sub_title']?>"
							   id="video_setting_page_sub_title" placeholder="内页副标题" >
							</div>
						</div>
						
					  </div>            
					</div>
				  </div>
				  <!-- !modal-body -->
				  <div class="modal-footer">
					<button type="submit" id="submit_button" class="btn btn-primary btn-standard">提交</button>
					<button type="button" id="reset_button" class="btn btn-default btn-standard">重置</button>          
				  </div>
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
	//重置
	$("#reset_button").click(function(){
		if(confirm('确定要重置吗?没有保存的数据会丢失') == true){
			refresh();
		}
	});
	//提交
	$("#submit_button").click(function(){
		//取数据
		var data={};
		//常规数据
		data.video_setting_menu_title = $("#video_setting_menu_title").val();
		data.video_setting_page_title = $("#video_setting_page_title").val();
		data.video_setting_page_sub_title = $("#video_setting_page_sub_title").val();
		data.valid = $("input[name='valid']:checked").val();		
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_video/save_video_setting',
	        data : data,
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
	
	
</script>
</html>