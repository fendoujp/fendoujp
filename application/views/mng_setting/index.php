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
						  <label class="col-sm-2 control-label">网站标题：</label>
							<div class="col-sm-7">
							   <input class="form-control" id="seo_title" 
							   placeholder="请填写内容" value="<?php echo $seo['seo_title']?>" >
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">网站简介：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:125px;" 
							   id="seo_intro" placeholder="请填写内容" ><?php echo $seo['seo_intro']?></textarea>
							</div>
						</div>
						<div class="form-group form-group-sm">
						  <label class="col-sm-2 control-label">网站关键字<br />(半角逗号隔开)：</label>
							<div class="col-sm-7">
							   <textarea class="form-control" style="height:75px;" 
							   id="seo_keyword" placeholder="请填写内容" ><?php echo $seo['seo_keyword']?></textarea>
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
		data.seo_title = $("#seo_title").val();
		data.seo_intro = $("#seo_intro").val();
		data.seo_keyword = $("#seo_keyword").val();		
		
		//ajax提交
		$.ajax({
	      type : 'post',
	        url : base_url + 'mng_setting/save_seo',
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