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
                  <li>文章管理</li>
                  <li>></li>
                  <li>编辑内容</li>
                </ul>
              </div>
              <div class="main">
                <div class="modal-content" style="margin-top:20px;">
				  <div class="modal-header">
					<h4 class="modal-title">更新自由文章内容</h4>
				  </div>      
				  <div class="form-horizontal">
					<div class="modal-body">
					  <div class="info-edit">
					  	<div class="form-group form-group-sm">
			              <label class="col-sm-2 control-label">排序：</label>
			                <div class="col-sm-7">
			                   <input type="text" value="<?php echo $article['sort']?>" 
			                   		disabled class="form-control form-control-sm" />
			                </div>
			            </div>
			            <div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">分类：</label>
							<div class="col-sm-7">
							   <input type="text" value="<?php echo $article['article_category_name']?$article['article_category_name']:'无分类'?>" 
			                   		disabled class="form-control form-control-sm" />
							</div>
						</div>
					  	<div class="form-group form-group-sm">
			              <label class="col-sm-2 control-label">标题：</label>
			                <div class="col-sm-7">
			                   <input type="text" value="<?php echo $article['article_title']?>" 
			                   		disabled class="form-control form-control-sm" />
			                </div>
			            </div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">副标题：</label>
							<div class="col-sm-7">
							   <input type="text" value="<?php echo $article['article_sub_title']?>" 
			                   		disabled class="form-control form-control-sm" />
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">封面图：</label>
							<div class="col-sm-7">
							   <img src="<?php echo $article['article_img']?>" 
			                   		style="width:370px;height:255px" />
							</div>
						</div>
						<br><hr><br>
					  	<div class="form-group form-group-sm">
					  		<label class="col-sm-2 control-label">文章内容：</label>
					  		<div class="col-sm-6"  style="margin-top:5px;">
					  			<span class="red-font">请注意:编辑模块时,文章内容会自动保存**</span>
					  		</div>
					  	</div>
					  	<div id="content_area" style="display: block">
					  	<?php //循环输出module?>
					  	<?php if($article_module){ ?>
					  	<?php foreach($article_module as $k=>$v){ ?>
					  		<!-- 空白模块 -->
					  		<?php if($v == 0){ ?>
					  			<div class="form-group form-group-sm">
									<label class="col-sm-2 control-label">分隔空行：</label>
									<div class="col-sm-7">
									   <input type="text" id="" disabled
					                        class="form-control form-control-sm" 
					                        placeholder="---------------空行--------------"/>
									</div>
									<br>
									<div class="col-sm-7" style="margin-left:16.7%;text-align: right">
										<button data-position="<?php echo $k?>" data-type="4" data-id="0" 
										class="small-btm btn btn-danger delete-module-button">删除</button>
										<button onclick="insert_module(<?php echo $k?>,1)" 
										class="small-btm btn btn-primary">+文章</button>
										<button onclick="insert_module(<?php echo $k?>,2)" 
										class="small-btm btn btn-primary">+图片</button>
										<button onclick="insert_module(<?php echo $k?>,3)" 
										class="small-btm btn btn-primary">+视频</button>
										<button onclick="insert_module(<?php echo $k?>,4)" 
										class="small-btm btn btn-primary">+空行</button>
									</div>
								</div>
					  		<?php }else{ ?>
					  			<!-- 文字模块 -->
					  			<?php if($module[$v]['module_type'] == 1){ ?>
					  				<div class="form-group form-group-sm">
									  <label class="col-sm-2 control-label">文字模块:</label>
										<div class="col-sm-7">
										   <textarea class="form-control" style="height:300px;" disabled 
										   placeholder="请填写内容" ><?php echo $module[$v]['module_content']?></textarea>
										</div>
										<br>
										<div class="col-sm-7" style="margin-left:16.7%;text-align: right">
											<button data-position="<?php echo $k?>" data-id="<?php echo $v?>" 
											data-data="<?php echo htmlspecialchars($module[$v]['module_content'])?>" 
											class="small-btm btn btn-warning update-content-button">更新</button>
											<button data-position="<?php echo $k?>" data-type="1" data-id="<?php echo $v?>" 
											class="small-btm btn btn-danger delete-module-button">删除</button>
											<button onclick="insert_module(<?php echo $k?>,1)" 
											class="small-btm btn btn-primary">+文章</button>
											<button onclick="insert_module(<?php echo $k?>,2)" 
											class="small-btm btn btn-primary">+图片</button>
											<button onclick="insert_module(<?php echo $k?>,3)" 
											class="small-btm btn btn-primary">+视频</button>
											<button onclick="insert_module(<?php echo $k?>,4)" 
											class="small-btm btn btn-primary">+空行</button>
										</div>
									</div>
								<?php }else if($module[$v]['module_type'] == 3){?>
									<div class="form-group form-group-sm">
									  <label class="col-sm-2 control-label">视频模块:</label>
										<div class="col-sm-7">
										   <iframe class="video_iframe" style="z-index:1;width:100%;height:400px;border:0;" 
											src="http://v.qq.com/iframe/player.html?vid=<?php echo $module[$v]['module_content']?>&auto=0" >
											</iframe>
										</div>
										<br>
										<div class="col-sm-7" style="margin-left:16.7%;text-align: right">
											<button data-position="<?php echo $k?>" data-id="<?php echo $v?>" 
											data-data="<?php echo htmlspecialchars($module[$v]['module_content'])?>" 
											class="small-btm btn btn-warning update-video-button">更新</button>
											<button data-position="<?php echo $k?>" data-type="3" data-id="<?php echo $v?>" 
											class="small-btm btn btn-danger delete-module-button">删除</button>
											<button onclick="insert_module(<?php echo $k?>,1)" 
											class="small-btm btn btn-primary">+文章</button>
											<button onclick="insert_module(<?php echo $k?>,2)" 
											class="small-btm btn btn-primary">+图片</button>
											<button onclick="insert_module(<?php echo $k?>,3)" 
											class="small-btm btn btn-primary">+视频</button>
											<button onclick="insert_module(<?php echo $k?>,4)" 
											class="small-btm btn btn-primary">+空行</button>
										</div>
									</div>
					  			<?php }else{ ?>
					  			<!-- 图片模块 -->
					  				<div class="form-group form-group-sm">
										<label class="col-sm-2 control-label">图片模块:</label>
										<div class="col-sm-7">							
											<img id="article_img" 
											src="<?php echo $module[$v]['module_img']?>" 
											style="width:100%;border:1px solid #ccc;"  
											/>
										</div>
										<br>
										<div class="col-sm-7" style="margin-left:16.7%;text-align: right">
											<button data-position="<?php echo $k?>" data-id="<?php echo $v?>" 
											data-data="<?php echo $module[$v]['module_img']?>" 
											class="small-btm btn btn-warning update-img-button">更新</button>
											<button data-position="<?php echo $k?>" data-type="2" data-id="<?php echo $v?>" 
											class="small-btm btn btn-danger delete-module-button">删除</button>
											<button onclick="insert_module(<?php echo $k?>,1)" 
											class="small-btm btn btn-primary">+文章</button>
											<button onclick="insert_module(<?php echo $k?>,2)" 
											class="small-btm btn btn-primary">+图片</button>
											<button onclick="insert_module(<?php echo $k?>,3)" 
											class="small-btm btn btn-primary">+视频</button>
											<button onclick="insert_module(<?php echo $k?>,4)" 
											class="small-btm btn btn-primary">+空行</button>
										</div>
									</div>
					  			<?php }?>					  			
					  		<?php }?>
					  	<?php }?>
					  	<?php }?>						  
						</div>
						<hr />
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-7" style="text-align:left;margin-top:20px;">
							<button class="add-new-content btn btn-primary">追加文章模块+</button>
							<button class="add-new-img btn btn-primary">追加图片模块+</button>
							<button class="add-new-video btn btn-primary">追加视频模块+</button>
							<button class="add-new-space btn btn-primary">追加分隔空行+</button>
							</div>
						</div>
					  </div>            
					</div>
				  </div>
				  <!-- !modal-body -->
				  <div class="modal-footer">
					<button type="submit" id="submit_button" class="btn btn-primary btn-standard">预览</button>
					<button type="button" id="back_button" class="btn btn-default btn-standard">返回</button>          
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

<!-- 文字模块 -->
<div class="modal fade" id="text_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">文字模块</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
            <div class="form-group form-group-sm red-font" style="margin-left:15%">
            	请注意:手动换行请使用(hh)特殊字体请使用(ts+)内容(ts-)缩进请使用(sj)
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">文字内容：</label>
                <div class="col-sm-7">
                <!-- 文字的内容 -->
                   <textarea class="form-control" style="height:500px;" 
                   id="edit_text_content" placeholder="请填写文章内容" ></textarea>
               	</div>
               	<!-- 模块的ID -->
               	<input type="hidden" id="edit_text_module_id" value="0" />
               	<!-- 编辑的位置 0=最后  -1=开始   其他位置=ID (仅新建时有效) -->
               	<input type="hidden" id="edit_text_position" value="0" />
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="text_modal_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 

<!-- 图片模块 -->
<div class="modal fade" id="img_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">图片模块</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
          	<div class="form-group form-group-sm red-font" style="margin-left:15%">
            	请注意:文章中的图片,宽870px 高度可以自己控制 推荐465px
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">上传图片：</label>
            	<!-- 图片上传 -->
            	<div class="col-sm-7">
	            	<div data-type="upload" data-upload-type="module_img" 
	            	data-img="#edit_module_img" class="a-i-input upload" 
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
            	<label class="col-sm-2 control-label">图片预览：</label>
            	<div class="col-sm-7">
            		<img id="edit_module_img" 
            		src="<?php echo $default_module_img?>" 
            		style="width:435px;border:1px solid #ccc;"  
            		/>
            	</div>
            </div>
               	<!-- 模块的ID -->
               	<input type="hidden" id="edit_img_module_id" value="0" />
               	<!-- 编辑的位置 -1=最后  0=开始   其他位置=ID (仅新建时有效) -->
               	<input type="hidden" id="edit_img_position" value="0" />
            	<!-- 旧图片 --更新时有效 -->
            	<input type="hidden" id="edit_img_old" value="" />
            
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="img_modal_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 

<!-- 视频模块 -->
<div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">视频模块</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">视频ID：</label>
                <div class="col-sm-7">
                <input type="text" id="edit_video_content" 
                        class="form-control form-control-sm" 
                        placeholder="请填写视频的ID"/>
               	</div>
               	<!-- 模块的ID -->
               	<input type="hidden" id="edit_video_module_id" value="0" />
               	<!-- 编辑的位置 0=最后  -1=开始   其他位置=ID (仅新建时有效) -->
               	<input type="hidden" id="edit_video_position" value="0" />
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="video_modal_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 

<!-- 重要隐藏信息 -->  
<input type="hidden" id="ajax_running" value="0" />
<input type="hidden" id="article_id" value="<?php echo @$article_id?>" />
<input type="hidden" id="default_module_img" value="<?php echo  htmlspecialchars($default_module_img)?>" />
</body>
<script>
ready(function(){
	//增加按钮点击
	$(".add-new-content").click(function(){
		$("#edit_text_module_id").val(0);//新建
		//创建位置,-1 = 最后   其他 = 当前index之前
		$("#edit_text_position").val(-1);//创建位置 最后
		//清除内容
		$("#edit_text_content").val('');
		//打开model
		$("#text_modal").modal('show');
	});
	//更新文章
	$(".update-content-button").each(function(){
		$(this).click(function(){
			var position = $(this).attr('data-position');
			var module_id = $(this).attr('data-id');
			var text_content = $(this).attr('data-data');

			$("#edit_text_module_id").val(module_id);//更新
			$("#edit_text_position").val(position);//创建位置
			$("#edit_text_content").val(text_content);
			//打开model
			$("#text_modal").modal('show');			
		});
	});
	
	//创建图
	$(".add-new-img").click(function(){
		$("#edit_img_module_id").val(0);//新建
		//创建位置,-1 = 最后   其他 = 当前index之前
		$("#edit_img_position").val(-1);//创建位置 最后
		$("#edit_img_old").val('');//旧图
		$("#edit_module_img").src($("#default_module_img").val());//默认图		
		//打开model
		$("#img_modal").modal('show');
	});
	//更新图
	$(".update-img-button").each(function(){
		$(this).click(function(){
			var position = $(this).attr('data-position');
			var module_id = $(this).attr('data-id');
			var module_img = $(this).attr('data-data');
			$("#edit_img_module_id").val(module_id);//新建
			//创建位置,-1 = 最后   其他 = 当前index之前
			$("#edit_img_position").val(position);//创建位置 最后
			$("#edit_img_old").val(module_img);//旧图
			$("#edit_module_img").src(module_img);//默认图		
			//打开model
			$("#img_modal").modal('show');	
		});
	});

	//创建视频
	$(".add-new-video").click(function(){
		$("#edit_video_module_id").val(0);//新建
		//创建位置,-1 = 最后   其他 = 当前index之前
		$("#edit_video_position").val(-1);//创建位置 最后
		//清除内容
		$("#edit_video_content").val('');
		//打开model
		$("#video_modal").modal('show');
	});
	//更新视频
	$(".update-video-button").each(function(){
		$(this).click(function(){
			var position = $(this).attr('data-position');
			var module_id = $(this).attr('data-id');
			var video_content = $(this).attr('data-data');
			$("#edit_video_module_id").val(module_id);//更新
			$("#edit_video_position").val(position);//创建位置
			$("#edit_video_content").val(video_content);
			//打开model
			$("#video_modal").modal('show');			
		});
	});

	//删除module
	$(".delete-module-button").each(function(){
		$(this).click(function(){
			var position = $(this).attr('data-position');
			var type = $(this).attr('data-type');
			var module_id = $(this).attr('data-id');
			console.log(position,type,module_id);
			//ajax提交锁定
			if($("#ajax_running").val() == 1){
				return;
			}else{
				$("#ajax_running").val('1');
			}
			//ajax保存模块内容
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_module/delete_module',
		        data : {'position':position,
						'type':type,
						'module_id':module_id,
						'parent':'article',//所属内容类型的表名
						'parent_id':$("#article_id").val() //所属内容类型的ID
			        	},
		        success : function(response){
			     //错误处理
		          if(!errorMsg(response)) {
		            if(response == '1'){
			            alert('保存成功');
			            //刷新网页
			            refresh();
		            }else{
						alert('保存失败');
		            }
		          }
		          //解除AJAX锁定
		          $("#ajax_running").val('0');
		        }
		    });
		});
	});

	//点击追加空格
	$(".add-new-space").click(function(){
		add_space(-1);//最末位
	});
	
	//保存按钮点击
	$("#text_modal_submit").click(function(){
		//模块ID
		var module_id = $("#edit_text_module_id").val();
		var op = "<?php echo UPDATE?>";
		if(module_id == 0){
			op = "<?php echo CREATE?>";
		}
		//位置
		var position = $("#edit_text_position").val();
		//内容
		var content = $("#edit_text_content").val();

		//获取article_id
		var article_id = $("#article_id").val();

		//ajax提交锁定
		if($("#ajax_running").val() == 1){
			return;
		}else{
			$("#ajax_running").val('1');
		}
		//ajax保存模块内容
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_module/save_module',
	        data : {'op':op,
		        	'module_id':module_id,
		        	'module_content':content,
		        	'module_type':1,
		        	'position':position,
					'parent':'article',//所属内容类型的表名
					'parent_id':article_id //所属内容类型的ID
		        	},
	        success : function(response){
		     //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
		            alert('保存成功');
		            //刷新网页
		            refresh();
	            }else{
					alert('保存失败');
	            }
	          }
	          //解除AJAX锁定
	          $("#ajax_running").val('0');
	        }
	    });
	});

	$("#img_modal_submit").click(function(){
		//模块ID
		var module_id = $("#edit_img_module_id").val();
		var op = "<?php echo UPDATE?>";
		if(module_id == 0){
			op = "<?php echo CREATE?>";
		}
		//位置
		var position = $("#edit_img_position").val();
		//内容
		var module_img = $("#edit_module_img").attr('src');
		if(module_img == $("#edit_img_old").val()){
			//直接关闭框框
			$("#img_modal").modal('hide');
			return;
		}		
		//获取article_id
		var article_id = $("#article_id").val();

		//ajax提交锁定
		if($("#ajax_running").val() == 1){
			return;
		}else{
			$("#ajax_running").val('1');
		}
		//ajax保存模块内容
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_module/save_module',
	        data : {'op':op,
		        	'module_id':module_id,
		        	'module_img':module_img,
		        	'module_type':2,
		        	'position':position,
					'parent':'article',//所属内容类型的表名
					'parent_id':article_id //所属内容类型的ID
					},
	        success : function(response){
		     //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
		            alert('保存成功');
		            //刷新网页
		            refresh();
	            }else{
					alert('保存失败');
	            }
	          }
	          //解除AJAX锁定
	          $("#ajax_running").val('0');
	        }
	    });
	});

	//提交视频
	$("#video_modal_submit").click(function(){
		//模块ID
		var module_id = $("#edit_video_module_id").val();
		var op = "<?php echo UPDATE?>";
		if(module_id == 0){
			op = "<?php echo CREATE?>";
		}
		//位置
		var position = $("#edit_video_position").val();
		//内容
		var content = $("#edit_video_content").val();

		//获取article_id
		var article_id = $("#article_id").val();

		//ajax提交锁定
		if($("#ajax_running").val() == 1){
			return;
		}else{
			$("#ajax_running").val('1');
		}
		//ajax保存模块内容
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_module/save_module',
	        data : {'op':op,
		        	'module_id':module_id,
		        	'module_content':content,
		        	'module_type':3,
		        	'position':position,
					'parent':'article',//所属内容类型的表名
					'parent_id':article_id //所属内容类型的ID
		        	},
	        success : function(response){
		     //错误处理
	          if(!errorMsg(response)) {
	            if(response == '1'){
		            alert('保存成功');
		            //刷新网页
		            refresh();
	            }else{
					alert('保存失败');
	            }
	          }
	          //解除AJAX锁定
	          $("#ajax_running").val('0');
	        }
	    });
	});
	
	//返回主菜单
	$("#back_button").click(function(){
		window.location = base_url + "mng_article";
	});
});

//插入内容
function insert_module(position,type){
	console.log(position,type);
	if(type == 4){
		add_space(position);
	}else if(type == 1){
		$("#edit_text_module_id").val(0);//新建
		//创建位置,-1 = 最后   其他 = 当前index之前
		$("#edit_text_position").val(position);//创建位置
		//打开model
		$("#text_modal").modal('show');
	}else if(type == 2){
		$("#edit_img_module_id").val(0);//新建
		//创建位置,-1 = 最后   其他 = 当前index之前
		$("#edit_img_position").val(position);//创建位置 
		//打开model
		$("#img_modal").modal('show');
	}else if(type == 3){
		$("#edit_video_module_id").val(0);//新建
		//创建位置,-1 = 最后   其他 = 当前index之前
		$("#edit_video_position").val(position);//创建位置 
		//打开model
		$("#video_modal").modal('show');
	}
}

//插入空行
function add_space(position){
	//获取article_id
	var article_id = $("#article_id").val();
	
	//ajax提交锁定
	if($("#ajax_running").val() == 1){
		return;
	}else{
		$("#ajax_running").val('1');
	}
	//ajax保存模块内容
	$.ajax({
      type : 'post',
        url : base_url + 'mng_module/add_space',
        data : {'position':position,
				'parent':'article',//所属内容类型的表名
				'parent_id':article_id //所属内容类型的ID
	        },
        success : function(response){
	     //错误处理
          if(!errorMsg(response)) {
            if(response == '1'){
	            alert('保存成功');
	            //刷新网页
	            refresh();
            }else{
				alert('保存失败');
            }
          }
          //解除AJAX锁定
          $("#ajax_running").val('0');
        }
    });
}




</script>
</html>