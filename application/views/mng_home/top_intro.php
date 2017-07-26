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
					<h4 class="modal-title">顶部介绍编辑</h4>
					<span style="">最后一次更新时间: <?php echo $top_intro['ut']?>
					最后一次更新人: <?php echo $top_intro['uer']?></span>
				  </div>      
				  <div class="form-horizontal">
					<div class="modal-body">
					  <div class="info-edit">
					  	<div class="form-group form-group-sm">
					  	<span class="blue-font" style="margin-left:133px;">上半部分</span>
					  	<span class="red-font" style="margin-left:30px;">请注意:手动换行请使用(hh)特殊字体请使用(ts+)内容(ts-)</span>
					  	</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">左上部分标题：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="top_intro_up1" placeholder="请填写内容" ><?php echo $top_intro['top_intro_up1']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">左侧图片：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="top_intro_up_img" 
								data-img="#top_intro_up_img" class="a-i-input upload" 
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
							<label class="col-sm-2 control-label">图片预览：<br>350*185</label>
							<div class="col-sm-7">
								<img id="top_intro_up_img" 
								src="<?php echo $top_intro['top_intro_up_img']?>" 
								style="width:350px;height:185px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="top_intro_up_img_old" 
								value="<?php echo $top_intro['top_intro_up_img']?>" />
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">左下部分注释：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="top_intro_up2" placeholder="请填写内容" ><?php echo $top_intro['top_intro_up2']?></textarea>
							</div>
						</div>         	
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">右侧文章：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:175px;" 
							   id="top_intro_up3" placeholder="请填写内容" ><?php echo $top_intro['top_intro_up3']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
			              <label class="col-sm-2 control-label">右侧文章跳转：</label>
			                <div class="col-sm-7">
			                   <input type="text" id="top_intro_up3_link" 
			                   		value="<?php echo $top_intro['top_intro_up3_link']?>"
			                        class="form-control form-control-sm" 
			                        placeholder="请输入 http:// 或者  https:// 开头的网址"/>
			                </div>
			            </div>
						
						<div class="form-group form-group-sm">
					  	<span class="blue-font" style="margin-left:133px;">下半部分</span>
					  	<span class="red-font" style="margin-left:30px;">请注意:手动换行请使用(hh)特殊字体请使用(ts+)内容(ts-)</span>
					  	</div>
						        
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">左侧标题：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="top_intro_down1" placeholder="请填写内容" ><?php echo $top_intro['top_intro_down1']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">右侧内容：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="top_intro_down2" placeholder="请填写内容" ><?php echo $top_intro['top_intro_down2']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label">上传图片：</label>
							<!-- 图片上传 -->
							<div class="col-sm-7">
								<div data-type="upload" data-upload-type="top_intro_down_img" 
								data-img="#top_intro_down_img" class="a-i-input upload" 
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
							<label class="col-sm-2 control-label">图片预览：<br>1600*420</label>
							<div class="col-sm-7">
								<img id="top_intro_down_img" 
								src="<?php echo $top_intro['top_intro_down_img']?>" 
								style="width:480px;height:166px;border:1px solid #ccc;"  
								/>
								<input type="hidden" id="top_intro_down_img_old" 
								value="<?php echo $top_intro['top_intro_down_img']?>" />
							</div>
						</div>
						<div class="form-group form-group-sm">
							<span class="blue-font" style="margin-left:133px;">数字动画</span>
					  		<span class="red-font" style="margin-left:30px;">数值必须填数字,符号可以不填</span>
					  	</div>
					  	<!-- 数字动画部分 -->					  	
			            <?php for($i=0;$i<=4;$i++){?>
			            <div class="form-group form-group-sm">
			              <label class="col-sm-2 control-label">第<?php echo $i+1?>列:</label>
			                <div class="col-sm-7">
		                        <input type="text" id="<?php echo 'ani_'.$i.'_0'?>" 
		                        value="<?php echo @$top_intro['ani']['ani_'.$i.'_0']?>" 
		                        class="form-control-sm form-control" placeholder="请输入数字" 
		                        style="width:90px;float:left;" />
		                        <input type="text" id="<?php echo 'ani_'.$i.'_1'?>" 
		                         value="<?php echo @$top_intro['ani']['ani_'.$i.'_1']?>" 
		                        class="form-control-sm form-control" placeholder="符号" 
		                        style="width:60px;float:left;margin-left:10px;" />
		                        <input type="text" id="<?php echo 'ani_'.$i.'_2'?>" 
		                         value="<?php echo @$top_intro['ani']['ani_'.$i.'_2']?>" 
		                        class="form-control-sm form-control" placeholder="请输入下方标题" 
		                        style="width:250px;float:left;margin-left:10px;" />
			                </div>
			            </div>
			            <?php }?>
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
		data.top_intro_up1 = $("#top_intro_up1").val();
		data.top_intro_up2 = $("#top_intro_up2").val();
		data.top_intro_up3 = $("#top_intro_up3").val();
		data.top_intro_up3_link = $("#top_intro_up3_link").val();
		data.top_intro_down1 = $("#top_intro_down1").val();
		data.top_intro_down2 = $("#top_intro_down2").val();
		//图片数据
		data.top_intro_up_img = $("#top_intro_up_img").attr('src');
		data.top_intro_up_img_change = 1;
		if(data.top_intro_up_img == $("#top_intro_up_img_old").val()){
			data.top_intro_up_img_change = 0;
		}
		data.top_intro_down_img = $("#top_intro_down_img").attr('src');
		data.top_intro_down_img_change = 1;
		if(data.top_intro_down_img == $("#top_intro_down_img_old").val()){
			data.top_intro_down_img_change = 0;
		}
		//动画数据
		data.ani_0_0 = $("#ani_0_0").val();data.ani_0_1 = $("#ani_0_1").val();data.ani_0_2 = $("#ani_0_2").val();
		data.ani_1_0 = $("#ani_1_0").val();data.ani_1_1 = $("#ani_1_1").val();data.ani_1_2 = $("#ani_1_2").val();
		data.ani_2_0 = $("#ani_2_0").val();data.ani_2_1 = $("#ani_2_1").val();data.ani_2_2 = $("#ani_2_2").val();
		data.ani_3_0 = $("#ani_3_0").val();data.ani_3_1 = $("#ani_3_1").val();data.ani_3_2 = $("#ani_3_2").val();
		data.ani_4_0 = $("#ani_4_0").val();data.ani_4_1 = $("#ani_4_1").val();data.ani_4_2 = $("#ani_4_2").val();
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_top_intro',
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


