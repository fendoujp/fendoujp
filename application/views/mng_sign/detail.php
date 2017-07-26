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
                  <li>在线报名</li>
                  <li>></li>
                  <li>报名详情</li>
                </ul>
              </div>
              <div class="main">       			
              	<div class="pos-title">报名概况</div>
              	<div class="row" style="padding:15px;">
              		<div style="width:100%;float:left;font-size:16px;">
              			报名提交时间：<?php echo date(DATE_YMDHIS,$sign['ct'])?>
              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              			当前状态：<?php if($sign['status'] == 1) echo '<span style="color:orange;font-weight:600">未对应<span>';
								  elseif($sign['status'] == 2) echo '<span style="color:blue;font-weight:600">对应中<span>';
								  elseif($sign['status'] == 3) echo '<span style="color:green;font-weight:600">成功</span>';
								  elseif($sign['status'] == 4) echo '<span style="color:purple;font-weight:600">失败</span>';
								  elseif($sign['status'] == 5) echo '<span style="color:red;font-weight:600">删除</span>';
							?>
              		</div>
              		<div style="width:100%;float:left;font-size:16px;">
              			最后更新时间：<?php echo $sign['ut']?date(DATE_YMDHIS,$sign['ut']):'---'?>
              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              			最后更新人：<?php echo $sign['uer_username']?$sign['uer_username']:'---'?>
              		</div>
              		<?php if($sign['status'] != 1){ ?>
              			<?php if($sign['status'] == 5){ ?>
		              		<div style="width:100%;float:left;font-size:16px;">
		              			删除时间：<?php echo $sign['dt']?date(DATE_YMDHIS,$sign['dt']):'---'?>
		              			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		              			删除人：<?php echo $sign['der']?$sign['der_username']:'---'?>
		              		</div>
	              		<?php }else{ ?>
		              		<div style="width:100%;float:left;font-size:16px;">
		              			对应开始时间：<?php echo $sign['dy_t']?date(DATE_YMDHIS,$sign['dy_t']):'---'?>
			              		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		              			对应开始提交人：<?php echo $sign['dy_er_username']?$sign['dy_er_username']:'---'?>
		              		</div>
		              		<?php if($sign['status'] == 3){ ?>
			              		<div style="width:100%;float:left;font-size:16px;">
			              			对应成功时间：<?php echo $sign['s_t']?date(DATE_YMDHIS,$sign['s_t']):'---'?>
				              		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			              			对应成功提交人：<?php echo $sign['s_er_username']?$sign['s_er_username']:'---'?>
		              		</div>
		              		<?php }else if($sign['status'] == 4){?>
			              		<div style="width:100%;float:left;font-size:16px;">
			              			对应失败时间：<?php echo $sign['f_t']?date(DATE_YMDHIS,$sign['f_t']):'---'?>
				              		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			              			对应失败提交人：<?php echo $sign['f_er']?$sign['f_er_username']:'---'?>
			              		</div>
		              		<?php }?>
	              		<?php }?>
              		<?php }?>
				</div>
				<div class="row" style="padding:0 15px;">
				<textarea id="memo" style="border:2px solid #cecece;resize:none;width:60%;height:150px"><?php echo $sign['memo']?></textarea>
					<button class="save_memo btn btn-primary" style="margin-bottom:26px">保存备注</button>
				</div>
				<div class="pos-title">报名详情</div>
				
				<div class="row" style="padding:0 15px;">
					<div class="sign-detail" style="clear:left;margin-bottom:30px">
						<button class="save_sign btn btn-primary" >保存报名信息</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="return btn btn-primary" >返回</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="reset btn btn-danger" >重置</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="<?php echo func::loc_url()?>mng_sign/download/<?php echo $sign['sign_id']?>">
							<button class="download btn btn-info" >下载</button>
						</a>
					</div>
					<div class="sign-detail" style="clear:left">
					本人姓名：<input type="text" id="name" value="<?php echo $sign['name']?>">
					</div>
					<div class="sign-detail">
					护照号码：<input type="text" id="passport" value="<?php echo $sign['passport']?>" >
					</div>
					<div class="sign-detail" style="clear:left">
					本人性别：<select id="gender">
							<option value="0">请选择</option>
							<?php foreach(consts::get_const_gender() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['gender']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
							<?php }?>
						</select>
					</div>
					<div class="sign-detail">
					申请者现状：<select id="apply_status">
								<option value="0">请选择</option>
								<?php foreach(consts::get_const_apply_status() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['apply_status']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
							<?php }?>
							</select>
					</div>
					<div class="sign-detail">
						生日：
						<input type="text" id="birth_year" value="<?php echo $sign['birth_year']?>" style="width:60px">&nbsp;年&nbsp;
						<input type="text" id="birth_month" value="<?php echo $sign['birth_month']?>" style="width:40px">&nbsp;月&nbsp;
						<input type="text" id="birth_day" value="<?php echo $sign['birth_day']?>" style="width:40px">&nbsp;日
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					出生省份：<input type="text" id="birth_province" value="<?php echo $sign['birth_province']?>">	
					</div>	
					<div class="sign-detail">
					出生城市：<input type="text" id="birth_city" value="<?php echo $sign['birth_city']?>">	
					</div>	
					<div class="sign-detail">
					户口省份：<input type="text" id="hukou_province" value="<?php echo $sign['hukou_province']?>">	
					</div>	
					<div class="sign-detail">
					户口城市：<input type="text" id="hukou_city" value="<?php echo $sign['hukou_city']?>">	
					</div>
					<!-- 独占一行 -->
					<div class="sign-detail" style="clear:left">
					现在住址：<input type="text" id="address" value="<?php echo $sign['address']?>" style="width:495px">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					父亲姓名：<input type="text" id="dad_name" value="<?php echo $sign['dad_name']?>">	
					</div>	
					<div class="sign-detail">
					父亲年龄：<input type="text" id="dad_age" value="<?php echo $sign['dad_age']?>">	
					</div>	
					<div class="sign-detail">
					母亲姓名：<input type="text" id="mom_name" value="<?php echo $sign['mom_name']?>">	
					</div>	
					<div class="sign-detail">
					母亲年龄：<input type="text" id="mom_age" value="<?php echo $sign['mom_age']?>">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					经费支付者姓名：<input type="text" id="payer_name" value="<?php echo $sign['payer_name']?>">	
					</div>
					<div class="sign-detail">
					与申请者关系：<input type="text" id="payer_relation" value="<?php echo $sign['payer_relation']?>">	
					</div>
					<div class="sign-detail">
					经费支付者年收：<input type="text" id="payer_income" value="<?php echo $sign['payer_income']?>">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					经费支付者单位：<input type="text" id="payer_work" value="<?php echo $sign['payer_work']?>" style="width:452px">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					移动电话：<input type="text" id="mobile" value="<?php echo $sign['mobile']?>">	
					</div>	
					<div class="sign-detail">
					固定电话：<input type="text" id="telphone" value="<?php echo $sign['telphone']?>">	
					</div>	
					<div class="sign-detail">
					微信帐号：<input type="text" id="wechat" value="<?php echo $sign['wechat']?>">	
					</div>	
					<div class="sign-detail">
					&nbsp;QQ&nbsp;帐号：<input type="text" id="qq" value="<?php echo $sign['qq']?>">	
					</div>
					<!-- 独占一行 -->
					<div class="sign-detail" style="clear:left">
					电子邮件：<input type="text" id="email" value="<?php echo $sign['email']?>" style="width:495px">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					是否来过日本：<select id="ever_come_japan">
								<option value="0">请选择</option>
								<?php foreach(consts::get_const_ever_come_japan() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['ever_come_japan']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
							<?php }?>
							</select>
					</div>
					<div class="sign-detail">
					赴日经历：<input type="text" id="come_japan_intro" value="<?php echo $sign['come_japan_intro']?>" style="width:518px">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					是否学过日语：<select id="ever_learn_japanese">
								<option value="0">请选择</option>
								<?php foreach(consts::get_const_ever_learn_japanese() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['ever_learn_japanese']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
							<?php }?>
							</select>
					</div>
					<div class="sign-detail">
					学习经历：<input type="text" id="learn_japanese_intro" value="<?php echo $sign['learn_japanese_intro']?>" style="width:518px">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					是否参加过日语级别考试：<select id="ever_test_japanese">
										<option value="0">请选择</option>
										<?php foreach(consts::get_const_ever_test_japanese() as $k=>$v){ ?>
										<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['ever_test_japanese']) echo 'selected' ?>>
											<?php echo $v['text']?>
										</option>
										<?php }?>
									</select>
					</div>
					<div class="sign-detail">
						考试时间：
						<input type="text" id="test_japanese_year" value="<?php echo $sign['test_japanese_year']?>" style="width:60px">&nbsp;年&nbsp;
						<input type="text" id="test_japanese_month" value="<?php echo $sign['test_japanese_month']?>" style="width:40px">&nbsp;月&nbsp;
					</div>
					<div class="sign-detail" style="clear:left">
					考试名称：<select id="test_japanese_name">
									<option value="0">未参加过</option>
									<?php foreach(consts::get_const_test_japanese_name() as $k=>$v){ ?>
									<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['test_japanese_name']) echo 'selected' ?>>
										<?php echo $v['text']?>
									</option>
									<?php }?>
								</select>
					</div>
					<div class="sign-detail">
					考试级别：<select id="test_japanese_level">
								<option value="0">未参加过</option>
								<?php foreach(consts::get_const_test_japanese_level($sign['test_japanese_name']) as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['test_japanese_level']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
								<?php }?>
							</select>
					</div>
					<div class="sign-detail">
					考试成绩：<input type="text" id="test_japanese_point" value="<?php echo $sign['test_japanese_point']?>"">	
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					高中名称：<input type="text" id="highschool_name" value="<?php echo $sign['highschool_name']?>">	
					</div>	
					<div class="sign-detail">
					高中类型：<select id="highschool_type">
								<option value="0">请选择</option>
								<?php foreach(consts::get_const_highschool_type() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['highschool_type']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
								<?php }?>
							</select>
					</div>
					<div class="sign-detail">
						毕业时间：
						<input type="text" id="highschool_year" value="<?php echo $sign['highschool_year']?>" style="width:60px">&nbsp;年&nbsp;
						<input type="text" id="highschool_month" value="<?php echo $sign['highschool_month']?>" style="width:40px">&nbsp;月&nbsp;
					</div>
					<div class="sign-detail">
					高考成绩：<input type="text" id="highschool_point" value="<?php echo $sign['highschool_point']?>"">	
					</div>
					
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					大学名称：<input type="text" id="collage_name" value="<?php echo $sign['collage_name']?>">	
					</div>
					<div class="sign-detail">
					专业名称：<input type="text" id="collage_class" value="<?php echo $sign['collage_class']?>">	
					</div>
					<div class="sign-detail" style="clear:left">
					大学类型：<select id="collage_type">
								<option value="0">请选择</option>
								<?php foreach(consts::get_const_collage_type() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['collage_type']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
								<?php }?>
							</select>
					</div>
					
					<div class="sign-detail">
					是否有学位证：<select id="collage_license">
								<option value="0">请选择</option>
								<?php foreach(consts::get_const_collage_license() as $k=>$v){ ?>
								<option value="<?php echo $v['value']?>" <?php if($v['value'] == $sign['collage_license']) echo 'selected' ?>>
									<?php echo $v['text']?>
								</option>
								<?php }?>
							</select>
					</div>
					<div class="sign-detail">
						毕业时间：
						<input type="text" id="collage_year" value="<?php echo $sign['collage_year']?>" style="width:60px">&nbsp;年&nbsp;
						<input type="text" id="collage_month" value="<?php echo $sign['collage_month']?>" style="width:40px">&nbsp;月&nbsp;
					</div>
					<!-- 换行 -->
					<div class="sign-detail" style="clear:left">
					希望申请的学校：<input type="text" id="apply_school" value="<?php echo $sign['apply_school']?>">	
					</div>
					<div class="sign-detail">
						希望入学时间：
						<input type="text" id="apply_year" value="<?php echo $sign['apply_year']?>" style="width:60px">&nbsp;年&nbsp;
						<input type="text" id="apply_month" value="<?php echo $sign['apply_month']?>" style="width:40px">&nbsp;月&nbsp;
					</div>
					<div class="sign-detail" style="clear:left;margin-top:30px;">
						<button class="save_sign btn btn-primary" >保存报名信息</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="return btn btn-primary" >返回</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="reset btn btn-danger" >重置</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="<?php echo func::loc_url()?>mng_sign/download/<?php echo $sign['sign_id']?>">
							<button class="download btn btn-info" >下载</button>
						</a>
					</div>
				</div>
				<div class="row" style="display:block;height:50px;"></div>
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
	$("#test_japanese_name").change(function(){
		if($(this).val() == 1){
			$("#test_japanese_level").html('<option value="0">未参加过</option>'+
											<?php foreach(consts::get_const_test_japanese_level(1) as $k=>$v){
											echo '\'<option value="'.$v['value'].'">'.$v['text'].'</option>\'+';
											}?>
										   '');
		}else if($(this).val() == 2){
			$("#test_japanese_level").html('<option value="0">未参加过</option>'+
					<?php foreach(consts::get_const_test_japanese_level(2) as $k=>$v){
					echo '\'<option value="'.$v['value'].'">'.$v['text'].'</option>\'+';
					}?>
				   '');
		}else if($(this).val() == 3){
			$("#test_japanese_level").html('<option value="0">未参加过</option>'+
					<?php foreach(consts::get_const_test_japanese_level(3) as $k=>$v){
					echo '\'<option value="'.$v['value'].'">'.$v['text'].'</option>\'+';
					}?>
				   '');
		}else{
			$("#test_japanese_level").html('<option value="0">未参加过</option>');
		}
	});

	$(".return").click(function(){
		history.go(-1);
	});
	$(".reset").click(function(){
		refresh();
	});

	$(".save_sign").click(function(){
		if(!confirm('确定要保存报名信息的更新吗?')) return;
		var data = {};
		data.name = $("#name").val();
		data.passport = $("#passport").val();
		data.gender = $("#gender").val();
		data.apply_status = $("#apply_status").val();
		data.birth_year = $("#birth_year").val();
		data.birth_month = $("#birth_month").val();
		data.birth_day = $("#birth_day").val();
		data.birth_province = $("#birth_province").val();
		data.birth_city = $("#birth_city").val();
		data.hukou_province = $("#hukou_province").val();
		data.hukou_city = $("#hukou_city").val();
		data.address = $("#address").val();
		data.dad_name = $("#dad_name").val();
		data.dad_age = $("#dad_age").val();
		data.mom_name = $("#mom_name").val();
		data.mom_age = $("#mom_age").val();
		data.payer_name = $("#payer_name").val();
		data.payer_relation = $("#payer_relation").val();
		data.payer_work = $("#payer_work").val();
		data.payer_income = $("#payer_income").val();
		data.mobile = $("#mobile").val();
		data.telphone = $("#telphone").val();
		data.wechat = $("#wechat").val();
		data.qq = $("#qq").val();
		data.email = $("#email").val();
		data.ever_come_japan = $("#ever_come_japan").val();
		data.come_japan_intro = $("#come_japan_intro").val();
		data.ever_learn_japanese = $("#ever_learn_japanese").val();
		data.learn_japanese_intro = $("#learn_japanese_intro").val();
		data.ever_test_japanese = $("#ever_test_japanese").val();
		data.test_japanese_year = $("#test_japanese_year").val();
		data.test_japanese_month = $("#test_japanese_month").val();
		data.test_japanese_name = $("#test_japanese_name").val();
		data.test_japanese_level = $("#test_japanese_level").val();
		data.test_japanese_point = $("#test_japanese_point").val();
		data.highschool_name = $("#highschool_name").val();
		data.highschool_type = $("#highschool_type").val();
		data.highschool_point = $("#highschool_point").val();
		data.highschool_year = $("#highschool_year").val();
		data.highschool_month = $("#highschool_month").val();
		data.collage_name = $("#collage_name").val();
		data.collage_class = $("#collage_class").val();
		data.collage_type = $("#collage_type").val();
		data.collage_license = $("#collage_license").val();
		data.collage_year = $("#collage_year").val();
		data.collage_month = $("#collage_month").val();
		data.apply_school = $("#apply_school").val();
		data.apply_year = $("#apply_year").val();
		data.apply_month = $("#apply_month").val();
		data.sign_id = <?php echo $sign['sign_id']?>;
		console.log(data);
		//ajax保存
		$.ajax({
	      type : 'post',
	        url : '<?php echo func::loc_url()?>' + 'mng_sign/save_sign',
	        data : data,
	        success : function(response){
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
	$(".save_memo").click(function(){
		var data={};
		data.memo = $("#memo").val();
		data.sign_id = <?php echo $sign['sign_id']?>;
		$.ajax({
	      type : 'post',
	        url : '<?php echo func::loc_url()?>' + 'mng_sign/save_memo',
	        data : data,
	        success : function(response){
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