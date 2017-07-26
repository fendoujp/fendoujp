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
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第一个倒计时内容：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_cd_title1" 
							   placeholder="请填写内容" value="<?php echo $head['head_cd_title1']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第一个倒计时日期：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_cd_time1" 
							   placeholder="格式2000-12-12" value="<?php echo date("Y-m-d",$head['head_cd_time1'])?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第一个倒计时链接：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_cd_link1" 
							   placeholder="http://或者https://开头" value="<?php echo $head['head_cd_link1']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第二个倒计时内容：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_cd_title2" 
							   placeholder="请填写内容" value="<?php echo $head['head_cd_title2']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第二个倒计时日期：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_cd_time2" 
							   placeholder="格式2000-12-12" value="<?php echo date("Y-m-d",$head['head_cd_time2'])?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第二个倒计时链接：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_cd_link2" 
							   placeholder="http://或者https://开头" value="<?php echo $head['head_cd_link2']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第一客服标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_qq_title1" 
							   placeholder="第一个客服名称" value="<?php echo $head['head_qq_title1']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第一客服QQ：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_qq1" 
							   placeholder="请填写QQ号" value="<?php echo $head['head_qq1']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第二客服标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_qq_title2" 
							   placeholder="第二个客服名称" value="<?php echo $head['head_qq_title2']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">第二客服QQ：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="head_qq2" 
							   placeholder="请填写QQ号" value="<?php echo $head['head_qq2']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">顶部LOGO：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="head_logo" 
								data-img="#head_logo" class="a-i-input upload" 
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
								<img id="head_logo" 
								src="<?php echo $head['head_logo']?>" 
								style="width:123px;height:32px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="head_logo_old" 
								value="<?php echo $head['head_logo']?>" />
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
		data.head_cd_time1 = $("#head_cd_time1").val();
		data.head_cd_time2 = $("#head_cd_time2").val();
		data.head_cd_link1 = $("#head_cd_link1").val();
		data.head_cd_title1 = $("#head_cd_title1").val();		
		data.head_cd_title2 = $("#head_cd_title2").val();	
		data.head_cd_link2 = $("#head_cd_link2").val();
		data.head_qq1 = $("#head_qq1").val();	
		data.head_qq2 = $("#head_qq2").val();
		data.head_qq_title1 = $("#head_qq_title1").val();	
		data.head_qq_title2 = $("#head_qq_title2").val();

		data.head_logo = $("#head_logo").attr('src');
		var head_logo_old = $("#head_logo_old").val();
		if(data.head_logo != head_logo_old){
			data.head_logo_change = 1; 
		}else{
			data.head_logo_change = 0;
		}
		
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_setting/save_head',
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