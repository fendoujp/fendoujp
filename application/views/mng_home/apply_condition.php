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
					<h4 class="modal-title">申请条件编辑</h4>
					<span style="">最后一次更新时间: <?php echo $apply_condition['ut']?>
					最后一次更新人: <?php echo $apply_condition['uer']?></span>
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
							   id="apply_condition_name" placeholder="请填写内容" ><?php echo $apply_condition['apply_condition_name']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">简介：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="apply_condition_content" placeholder="请填写内容" ><?php echo $apply_condition['apply_condition_content']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">按钮文字：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="apply_condition_button" placeholder="请填写内容" ><?php echo $apply_condition['apply_condition_button']?></textarea>
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
		data.apply_condition_name = $("#apply_condition_name").val();
		data.apply_condition_content = $("#apply_condition_content").val();
		data.apply_condition_button = $("#apply_condition_button").val();
		
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_home/save_apply_condition',
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