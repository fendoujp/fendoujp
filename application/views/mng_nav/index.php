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
                  <li>导航管理</li>
                </ul>
              </div>
              <div class="main"> 
              	<div class="row-1" style="margin-top:0px;">
              	<button class="add-new btn btn-primary" style="float:left;" id="create_menu_button">添加新的导航栏+</button>
              	</div> 
                <div class="pos-title nav-title-div">
              		<span>首页</span>              		
              	</div>
              	<hr />
              	<?php foreach($menu as $k=>$v){ ?>
              		<div class="pos-title nav-title-div">
	              		<span><?php echo $v['menu_title']?></span>
	              		<span class="nav-span-red delete_menu_button" data-id="<?php echo $v['menu_id']?>">删除</span>
	              		<span class="nav-span-blue update_menu_button" 
	              			data-title="<?php echo htmlspecialchars($v['menu_title'])?>" 
	              			data-sort="<?php echo $v['sort']?>" data-id="<?php echo $v['menu_id']?>">
	              			修改
	              		</span>
	              		<span class="nav-span-blue create_nav_button" data-menu-id="<?php echo $v['menu_id']?>">添加子导航</span>
	              		
	              	</div>
	              	<?php //这里开始循环输出子导航?>
	              	<?php foreach($v['nav'] as $k2=>$v2){ ?>
	              		<?php //如果是普通的导航?>
	              		<?php if($v2['nav_type'] == 0){ ?>
		              		<div class="nav-div">
			              		<span style="margin-left:40px;"><?php echo $v2['nav_title']?></span>
			              		<span class="nav-span-red delete-nav-button" 
			              		data-id="<?php echo $v2['nav_id']?>">删除</span>
			              		<span class="nav-span-blue update-nav-button" 
			              		data-title="<?php echo htmlspecialchars($v2['nav_title'])?>" 
			              		data-sort="<?php echo $v2['sort']?>" data-type="<?php echo $v2['nav_type']?>" 
			              		data-menu-id="<?php echo $v2['nav_menu_id']?>" data-id="<?php echo $v2['nav_id']?>" >
			              		修改</span>			              		
			              		<span class="nav-span-blue nav-module-button" data-id="<?php echo $v2['nav_id']?>">
			              		编辑内容</span>
			              		<?php if(!$v2['nav_module'] || $v2['nav_module'] == '[]'){?>
			              			<span class="nav-span-red" style="margin-right:100px;">无内容</span>
			              		<?php }else{ ?>
			              			<span class="nav-span-blue" style="margin-right:100px;color:green">有内容</span>
			              		<?php }?> 		
			              	</div>
		              	<?php //如果是特殊模块的导航?>
		              	<?php }else{ ?>
		              		<div class="nav-div">
			              		<span style="margin-left:40px;"><?php echo $v2['nav_title']?></span>
			              		<span class="nav-span-red delete-nav-button" 
			              		data-id="<?php echo $v2['nav_id']?>">删除</span>
			              		<span class="nav-span-blue update-nav-button" 
			              		data-title="<?php echo htmlspecialchars($v2['nav_title'])?>" 
			              		data-sort="<?php echo $v2['sort']?>" data-type="<?php echo $v2['nav_type']?>" 
			              		data-menu-id="<?php echo $v2['nav_menu_id']?>" data-id="<?php echo $v2['nav_id']?>" 
			              		data-content="连接到 -> <?php echo $const_nav[$v2['nav_type']]['text']?>" >
			              		修改</span>
			              		<span class="nav-span-blue" style="margin-right:168px;">
			              			<?php echo $const_nav[$v2['nav_type']]['text']?>
			              		</span>
			              	</div>
		              	<?php }?>
	              	<?php }?>
	              	<hr />
              	<?php }?>              	
              	<hr />  
              	<div class="pos-title nav-title-div">
              		<span>视频展示</span>              		
              	</div>
              	<hr />   
              	<div class="pos-title nav-title-div">
              		<span>申请报名</span>              		
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
      
<!-- modal -->
<div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加/编辑主导航</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">            
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">排序：</label>
                <div class="col-sm-7">
                   <input type="text" id="menu_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                </div>
            </div>          	
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="menu_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                   <input type="hidden" id="menu_id" value="0" />
                </div>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="menu_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
<!-- modal -->
<div class="modal fade" id="nav_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">添加/编辑副导航</h4>
      </div>      
      <div class="form-horizontal">
        <div class="modal-body">
          <div class="info-edit">            
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">排序：</label>
                <div class="col-sm-7">
                   <input type="text" id="nav_sort" 
                        class="form-control form-control-sm" 
                        placeholder="请输入0-256的排序值，值越大排位越靠前(默认0)"/>
                </div>
                <!-- ID -->
                <input type="hidden" id="nav_id" value="0" />
            </div>
          	<div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-7">
                   <input type="text" id="nav_title" 
                        class="form-control form-control-sm" 
                        placeholder="请填写内容"/>
                </div>
            </div>
            <div class="form-group form-group-sm">
              <label class="col-sm-2 control-label">主导航：</label>
                <div class="col-sm-7">
	                <select id="nav_menu_id">
	                	<?php foreach($menu as $k=>$v){ ?>
	                		<option value="<?php echo $v['menu_id']?>"><?php echo $v['menu_title']?></option>
	                	<?php }?>
	                </select>
                </div>
            </div>            
            <div class="form-group form-group-sm">
            	<span style="color:red;margin-left:150px;">注意:导航类型在编辑时无法更改</span>
            </div>
            <div class="form-group form-group-sm">
            	<label class="col-sm-2 control-label">导航类型：</label>
            	<div class="col-sm-7">
	                <select id="nav_type">
	                	<option value="0">普通内容页面</option>	                	
	                	<?php foreach($const_nav_valid as $k=>$v){ ?>
	                		<option value="<?php echo $k?>">跳转到:<?php echo $v['text']?></option>
	                	<?php }?>
	                </select>
                </div>
            </div>
            <div class="form-group form-group-sm" id="nav_type_hidden_div">
            	<span style="color:red;margin-left:150px;" id="nav_type_hidden_span"></span>
            </div>
          </div>            
        </div>
      </div>
      <!-- !modal-body -->
      <div class="modal-footer">
        <button type="submit" id="nav_submit" class="btn btn-primary btn-standard" >确 定</button>
        <button type="button" data-action="close" class="btn btn-default btn-standard" data-dismiss="modal">关 闭</button>          
      </div>
    </div>      
  </div>
</div>
<!-- !modal --> 
  
  
  </body>
<script>
ready(function(){
	
	$('#create_menu_button').click(function(){
		//点击打开创建modal
		$("#menu_title").val('');
		$("#menu_sort").val('');
		$("#menu_id").val(0);
		$("#menu_modal").modal('show');		
	});
	$(".update_menu_button").each(function(){
		//点击修改menu
		$(this).click(function(){
			$("#menu_title").val($(this).attr('data-title'));
			$("#menu_sort").val($(this).attr('data-sort'));
			$("#menu_id").val($(this).attr('data-id'));
			$("#menu_modal").modal('show');		
		});
	});
	
	//提交menu
	$('#menu_submit').click(function(){		
		var menu_data = {};
		menu_data.menu_title = $("#menu_title").val();
		menu_data.sort = $("#menu_sort").val();
		menu_data.menu_id  = $("#menu_id").val();
		if(menu_data.menu_id == 0){
			menu_data.op = '<?php echo CREATE?>';
		}else{
			menu_data.op = '<?php echo UPDATE?>';
		}
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_nav/save_menu',
	        data : menu_data,
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

//----------
	//打开子导航
	$(".create_nav_button").each(function(){		
		$(this).click(function(){
			var menu_id = $(this).attr('data-menu-id');
			$("#nav_id").val(0);
			$("#nav_sort").val('');
			$("#nav_title").val('');
			$("#nav_menu_id").val(menu_id);			
			$("#nav_type").disabled(false);			
			$("#nav_type").val(0);
			$("#nav_type_hidden_div").hide();
			$("#nav_type").show();
			$("#nav_modal").modal('show');
		});
	});
	$(".update-nav-button").each(function(){
		$(this).click(function(){			
			var menu_id = $(this).attr('data-menu-id');
			$("#nav_id").val($(this).attr('data-id'));
			$("#nav_sort").val($(this).attr('data-sort'));
			$("#nav_title").val($(this).attr('data-title'));
			$("#nav_menu_id").val(menu_id);
			$("#nav_type").val($(this).attr('data-type'));
			$("#nav_type").disabled(true);
			//如果不是普通的导航,显示导航信息
			if($(this).attr('data-type') > 0){
				var content = $(this).attr('data-content');
				$("#nav_type_hidden_span").html(content);
				$("#nav_type_hidden_div").show();
				$("#nav_type").hide();
			}else{
				$("#nav_type_hidden_div").hide();
				$("#nav_type").show();
			}			
			$("#nav_modal").modal('show');
		});
	});

	//保存子导航
	$('#nav_submit').click(function(){		
		var nav_data = {};
		nav_data.nav_title = $("#nav_title").val();
		nav_data.sort = $("#nav_sort").val();
		nav_data.nav_id  = $("#nav_id").val();
		nav_data.nav_menu_id  = $("#nav_menu_id").val();
		nav_data.nav_type  = $("#nav_type").val();
		if(nav_data.nav_id == 0){
			nav_data.op = '<?php echo CREATE?>';
		}else{
			nav_data.op = '<?php echo UPDATE?>';
		}
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_nav/save_nav',
	        data : nav_data,
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

//------------------------------
	
	//点击去编辑nav文章内容
	$('.nav-module-button').each(function(){
		//直接打开新页面编辑
		$(this).click(function(){			
			var nav_id = $(this).attr('data-id');
			window.location = base_url + "mng_nav/edit_nav/" + nav_id;
		});
	});
		
	//删除
	$('.delete-nav-button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复') == false){
				return;
			}
			//获取ID
			var nav_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_nav/delete_nav',
		        data : {'nav_id':nav_id},
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
	//删除
	$('.delete_menu_button').each(function(){
		$(this).click(function(){
			if(confirm('确定要删除吗?删除后不能恢复,无法删除含有子目录的目录!') == false){
				return;
			}
			//获取ID
			var menu_id = $(this).attr('data-id');
			//ajax提交
			$.ajax({
		      type : 'post',
		        url : base_url + 'mng_nav/delete_menu',
		        data : {'menu_id':menu_id},
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
	
})

</script>
</html>


