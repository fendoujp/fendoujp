<!DOCTYPE html>
<html lang="zh-cn">
  <?php include VIEWPATH.'mng_common/mng-head.php'; ?>
  <body>
      <div class="wrapper">
        <?php include VIEWPATH.'mng_common/mng-header.php'; ?>
        <!-- !footer -->
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
					  	<span class="red-font" style="margin-left:133px;">请注意:手动换行请使用(hh)缩进请用(sj)</span>
					  	<br /><br />
						
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">公司介绍<br>(左下角)：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:125px;" 
							   id="foot_intro" placeholder="请填写内容" ><?php echo $foot['foot_intro']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">联系我们</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:125px;" 
							   id="foot_contact" placeholder="请填写内容" ><?php echo $foot['foot_contact']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">底部部LOGO：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="foot_logo" 
								data-img="#foot_logo" class="a-i-input upload" 
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
							<label class="col-sm-2 control-label">图片预览：<br>123*32px</label>
							<div class="col-sm-7">
								<img id="foot_logo" 
								src="<?php echo $foot['foot_logo']?>" 
								style="width:123px;height:32px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="foot_logo_old" 
								value="<?php echo $foot['foot_logo']?>" />
							</div>
						</div>
						<hr />
						
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">社交平台1 标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="foot_pt_title1" 
							   placeholder="请填写内容" value="<?php echo $foot['foot_pt_title1']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">社交平台1 内容：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="foot_pt_content1" 
							   placeholder="请填写内容" value="<?php echo $foot['foot_pt_content1']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">社交平台1 LOGO：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="foot_pt_img1" 
								data-img="#foot_pt_img1" class="a-i-input upload" 
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
							<label class="col-sm-2 control-label">图片预览：<br>120*120px</label>
							<div class="col-sm-7">
								<img id="foot_pt_img1" 
								src="<?php echo $foot['foot_pt_img1']?>" 
								style="width:120px;height:120px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="foot_pt_img1_old" 
								value="<?php echo $foot['foot_pt_img1']?>" />
							</div>
						</div>
						
						<hr />
						
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">社交平台2 标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="foot_pt_title2" 
							   placeholder="请填写内容" value="<?php echo $foot['foot_pt_title2']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">社交平台2 内容：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="foot_pt_content2" 
							   placeholder="请填写内容" value="<?php echo $foot['foot_pt_content2']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">社交平台2 LOGO：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="foot_pt_img2" 
								data-img="#foot_pt_img2" class="a-i-input upload" 
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
							<label class="col-sm-2 control-label">图片预览：<br>120*120px</label>
							<div class="col-sm-7">
								<img id="foot_pt_img2" 
								src="<?php echo $foot['foot_pt_img2']?>" 
								style="width:120px;height:120px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="foot_pt_img2_old" 
								value="<?php echo $foot['foot_pt_img2']?>" />
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
		data.foot_pt_title1 = $("#foot_pt_title1").val();
		data.foot_pt_content1 = $("#foot_pt_content1").val();
		data.foot_pt_img1 = $("#foot_pt_img1").attr('src');
		if(data.foot_pt_img1 != $("#foot_pt_img1_old").val()){
			data.foot_pt_img1_change = 1;
		}else{
			data.foot_pt_img1_change = 0;
		}
		data.foot_pt_title2 = $("#foot_pt_title2").val();
		data.foot_pt_content2 = $("#foot_pt_content2").val();
		data.foot_pt_img2 = $("#foot_pt_img2").attr('src');
		if(data.foot_pt_img2 != $("#foot_pt_img2_old").val()){
			data.foot_pt_img2_change = 1;
		}else{
			data.foot_pt_img2_change = 0;
		}		
		data.foot_intro = $("#foot_intro").val();		
		data.foot_contact = $("#foot_contact").val();	
		
		data.foot_logo = $("#foot_logo").attr('src');
		var foot_logo_old = $("#foot_logo_old").val();
		if(data.foot_logo != foot_logo_old){
			data.foot_logo_change = 1; 
		}else{
			data.foot_logo_change = 0;
		}
		
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_setting/save_foot',
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