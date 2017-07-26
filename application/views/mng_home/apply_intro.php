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
                  <li>首页</li>
                  <li>></li>
                  <li><?php echo $submenu['position']?></li>
                </ul>
              </div>
              <div class="main">
              	<?php echo $submenu['menu_html']?>
                <div class="modal-content" style="margin-top:20px;">
				  <div class="modal-header">
					<h4 class="modal-title">申请流程编辑</h4>
					<span style="">最后一次更新时间: <?php echo $apply_intro['ut']?>
					最后一次更新人: <?php echo $apply_intro['uer']?></span>
				  </div>      
				  <div class="form-horizontal">
					<div class="modal-body">
					  <div class="info-edit">
					  
					  	<div class="form-group form-group-sm">
					  	<span class="red-font" style="margin-left:133px;">请注意:手动换行请使用(hh)特殊字体请使用(ts+)内容(ts-)</span>
					  	</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">标题：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="apply_intro_name" placeholder="请填写内容" ><?php echo $apply_intro['apply_intro_name']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">简介：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:175px;" 
							   id="apply_intro_content" placeholder="请填写内容" ><?php echo $apply_intro['apply_intro_content']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">左侧图片：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="apply_intro_img" 
								data-img="#apply_intro_img" class="a-i-input upload" 
								style="width:300px;">
									<input type="text" class="form-control form-control-sm" 
									style="padding-left:30px;" placeholder="点击选择文件（jpg,jpeg,png,gif 2M以内）" />
									<input type="file" />
									<div class="upload-icon">
										<i class="fa fa-upload"></i>
									</div>
								</div>      
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">图片预览：<br>555*265</label>
							<div class="col-sm-7">
								<img id="apply_intro_img" 
								src="<?php echo $apply_intro['apply_intro_img']?>" 
								style="width:333px;height:159px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="apply_intro_img_old" 
								value="<?php echo $apply_intro['apply_intro_img']?>" />
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
		data.apply_intro_name = $("#apply_intro_name").val();
		data.apply_intro_content = $("#apply_intro_content").val();
		
		//图片数据
		data.apply_intro_img = $("#apply_intro_img").attr('src');
		data.apply_intro_img_change = 1;
		if(data.apply_intro_img == $("#apply_intro_img_old").val()){
			data.apply_intro_img_change = 0;
		}		
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_apply_intro',
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