<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 管理端 在线留言管理
 * MyDivine
 * 2016-10-22
 */
class Mng_sign extends AC{
	//构造方法
	public function __construct(){
		parent::__construct();	
		$this->load->model('sign_model');
	}
	//sign控制
	public function index($status = 0,$page = 1){
		$per = 10;//每页10条
		$page = intval($page);
		//-1=未读 1=已读 2=删除
		//0=全部
		$status = intval($status);/// 1=未对应  2=对应中 3=成功 4=失败 5=被删除
		if($status < 1 || $status > 5) $status = 0;
		//获取总数
		$total = $this->sign_model->get_sign_count($status);
		
		//修正page
		if($page < 1)$page = 1;
		$max_page = ceil($total/$per);
		if($max_page < 1) $max_page = 1;
		if($page > $max_page) $page = $max_page;
		
		//获取列表
		$sign_list = $this->sign_model->get_sign_list($page,$per,$status);
		if($sign_list){
			foreach($sign_list as $k=>$v){
				//处理时间
				$sign_list[$k]['ct'] = date("Y-m-d",$v['ct']).'<br>'.date("H:i:s",$v['ct']);
				$sign_list[$k]['ut'] = $v['ut']?date("Y-m-d",$v['ut']).'<br>'.date("H:i:s",$v['ut']):'---';
				$sign_list[$k]['uer_username'] = $v['uer_username'] ? $v['uer_username']:'---';
			}
		}
		$this->info['sign_list'] = $sign_list;
		$this->info['total'] = $total;
		$this->info['get']['page'] = $page;
		$this->info['max_page'] = $max_page;
		$this->info['get']['status'] = $status;
		//func::debug();
		$this->v();
	}
	//保存已读
	public function status_read(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update = array();
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];
		$update['status'] = 1;
		if($this->sign_model->update_sign($update,$sign_id))exit('1');
		exit('0');
	}
	//删除
	public function delete_sign(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update = array();
		$update['dt'] = time();
		$update['der'] = $this->info['admin']['admin_id'];
		$update['status'] = 5;
		if($this->sign_model->update_status($update,$sign_id,'delete'))exit('1');
		exit('0');
	}
	//开始对应
	public function operate_sign(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update = array();
		$update['dy_t'] = time();
		$update['dy_er'] = $this->info['admin']['admin_id'];
		$update['status'] = 2;
		if($this->sign_model->update_status($update,$sign_id,'operate'))exit('1');
		exit('0');
	}
	//成功
	public function success_sign(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update = array();
		$update['s_t'] = time();
		$update['s_er'] = $this->info['admin']['admin_id'];
		$update['status'] = 3;
		if($this->sign_model->update_status($update,$sign_id,'success'))exit('1');
		exit('0');
	}
	//失败
	public function fail_sign(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update = array();
		$update['f_t'] = time();
		$update['f_er'] = $this->info['admin']['admin_id'];
		$update['status'] = 4;
		if($this->sign_model->update_status($update,$sign_id,'fail'))exit('1');
		exit('0');
	}
	//恢复到对应中
	public function reverse(){
		/// 1=未对应  2=对应中 3=成功 4=失败 5=被删除
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update = array();
		$update['status'] = 2;
		if($this->sign_model->update_status($update,$sign_id,'reverse'))exit('1');
		exit('0');
	}
	
	//详情页面
	public function detail($sign_id = 0){
		$sign_id = intval($sign_id);
		if($sign_id < 1)redirect('mng_sign');
		$sign = $this->sign_model->get_sign_by_id($sign_id);
		if(!$sign)redirect('mng_sign');
		$this->info['sign'] = $sign;
		$this->v();
	}
		
	//保存备注
	public function save_memo(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1)exit('0');
		$update['memo'] = trim($this->input->post('memo'));
		$this->sign_model->update_sign($update,$sign_id);
		exit('1');
	}
	
	//保存表单
	public function save_sign(){
		$sign_id = intval($this->input->post('sign_id'));
		if($sign_id < 1) exit('0');
		$error = array();
		$update = array();
		//name
		$update['name'] = trim($this->input->post('name'));
		if(!$update['name'] || strlen($update['name']) > 45){
			$error['name'.FORM_ERROR_TAIL] = '请输入姓名';
		}
		//passport
		$update['passport'] = trim($this->input->post('passport'));
		if(!$update['passport'] || strlen($update['passport']) > 45){
			$error['passport'.FORM_ERROR_TAIL] = '请输入护照号码';
		}
		//gender
		$update['gender'] = $this->input->post('gender');
		if(!func::get_const_text('gender',$update['gender'])){
			$error['gender'.FORM_ERROR_TAIL] = '请选择性别';
		}
		//apply_status
		$update['apply_status'] = $this->input->post('apply_status');
		if(!func::get_const_text('apply_status',$update['apply_status'])){
			$error['apply_status'.FORM_ERROR_TAIL] = '请选择申请者当前状态';
		}
		//年月日
		$update['birth_year'] = $this->input->post('birth_year');
		$update['birth_month'] = $this->input->post('birth_month');
		$update['birth_day'] = $this->input->post('birth_day');
		if(!func::check_date($update['birth_year'].'-'.$update['birth_month'].'-'.$update['birth_day'])){
			$error['birthday'.FORM_ERROR_TAIL] = '生日日期错误';
		}
		//birth_province
		$update['birth_province'] = trim($this->input->post('birth_province'));
		if(!$update['birth_province'] || strlen($update['birth_province']) > 45){
			$error['birth_province'.FORM_ERROR_TAIL] = '请输入出生省份';
		}
		//birth_city
		$update['birth_city'] = trim($this->input->post('birth_city'));
		if(!$update['birth_city'] || strlen($update['birth_city']) > 45){
			$error['birth_city'.FORM_ERROR_TAIL] = '请输入出生城市';
		}
		//hukou_province
		$update['hukou_province'] = trim($this->input->post('hukou_province'));
		if(!$update['hukou_province'] || strlen($update['hukou_province']) > 45){
			$error['hukou_province'.FORM_ERROR_TAIL] = '请输入户口省份';
		}
		//hukou_city
		$update['hukou_city'] = trim($this->input->post('hukou_city'));
		if(!$update['hukou_city'] || strlen($update['hukou_city']) > 45){
			$error['hukou_city'.FORM_ERROR_TAIL] = '请输入户口城市';
		}
		//address
		$update['address'] = trim($this->input->post('address'));
		if(!$update['address'] || strlen($update['address']) > 255){
			$error['address'.FORM_ERROR_TAIL] = '请输入现在住址';
		}
		//dad_name
		$update['dad_name'] = trim($this->input->post('dad_name'));
		if(!$update['dad_name'] || strlen($update['dad_name']) > 45){
			$error['dad_name'.FORM_ERROR_TAIL] = '请输入父亲姓名';
		}
		//dad_age
		$update['dad_age'] = intval($this->input->post('dad_age'));
		if(!$update['dad_age'] || $update['dad_age'] < 1){
			$error['dad_age'.FORM_ERROR_TAIL] = '请输入父亲年龄';
		}
		//mom_name
		$update['mom_name'] = trim($this->input->post('mom_name'));
		if(!$update['mom_name'] || strlen($update['mom_name']) > 45){
			$error['mom_name'.FORM_ERROR_TAIL] = '请输入母亲姓名';
		}
		//mom_age
		$update['mom_age'] = intval($this->input->post('mom_age'));
		if(!$update['mom_age'] || $update['mom_age'] < 1){
			$error['mom_age'.FORM_ERROR_TAIL] = '请输入母亲年龄';
		}
		//payer_name
		$update['payer_name'] = trim($this->input->post('payer_name'));
		if(!$update['payer_name'] || strlen($update['payer_name']) > 45){
			$error['payer_name'.FORM_ERROR_TAIL] = '请输入经费支付者姓名';
		}
		//payer_relation
		$update['payer_relation'] = trim($this->input->post('payer_relation'));
		if(!$update['payer_relation']||strlen($update['payer_relation']) > 45){
			$error['payer_relation'.FORM_ERROR_TAIL] = '请输入经费支付者与申请人关系';
		}
		//payer_work
		$update['payer_work'] = trim($this->input->post('payer_work'));
		if(!$update['payer_work'] || strlen($update['payer_work']) > 255){
			$error['payer_work'.FORM_ERROR_TAIL] = '请输入经费支付者工作单位';
		}
		$update['payer_income'] = trim($this->input->post('payer_income'));
		if(!$update['payer_income']||strlen($update['payer_income']) > 45){
			$error['payer_income'.FORM_ERROR_TAIL] = '请输入经费支付者年收';
		}
		//mobile
		$update['mobile'] = trim($this->input->post('mobile'));
		if(!$update['mobile'] || strlen($update['mobile']) > 45){
			$error['mobile'.FORM_ERROR_TAIL] = '请输入手机号';
		}
		//telphone
		$update['telphone'] = trim($this->input->post('telphone'));
		if(!$update['telphone'] || strlen($update['telphone']) > 45){
			$error['telphone'.FORM_ERROR_TAIL] = '请输入手机号码';
		}
		//wechat
		$update['wechat'] = trim($this->input->post('wechat'));
		if(!$update['wechat'] || strlen($update['wechat']) > 45){
			$error['wechat'.FORM_ERROR_TAIL] = '请输入微信号';
		}
		//qq
		$update['qq'] = trim($this->input->post('qq'));
		if(!$update['qq'] || strlen($update['qq']) > 45){
			$error['qq'.FORM_ERROR_TAIL] = '请输入QQ号';
		}
		//email
		$update['email'] = trim($this->input->post('email'));
		if(!$update['email']||strlen($update['email'])>45||!strpos($update['email'],'@')){
			$error['email'.FORM_ERROR_TAIL] = '请输入电子邮箱';
		}
		//ever_come_japan
		$update['ever_come_japan'] = $this->input->post('ever_come_japan');
		if(!func::get_const_text('ever_come_japan',$update['ever_come_japan'])){
			$error['ever_come_japan'.FORM_ERROR_TAIL] = '请选择是否来过日本';
		}else{
			if($update['ever_come_japan'] == 2){
				$update['come_japan_intro'] = '';//如果没来过 这里直接为空
			}else{
				//如果来过  处理  come_japan_intro
				$update['come_japan_intro'] = trim($this->input->post('come_japan_intro'));
				if(!$update['come_japan_intro'] || strlen($update['come_japan_intro']) > 255){
					$error['come_japan_intro'.FORM_ERROR_TAIL] = '请输入赴日经历';
				}
			}
		}
		//ever_learn_japanese
		$update['ever_learn_japanese'] = $this->input->post('ever_learn_japanese');
		if(!func::get_const_text('ever_learn_japanese',$update['ever_learn_japanese'])){
			$error['ever_learn_japanese'.FORM_ERROR_TAIL] = '请选择是否学过日语';
		}else{
			if($update['ever_learn_japanese'] == 2){
				$update['learn_japanese_intro'] = '';//如果没学过 这里直接为空
			}else{
				//如果学过  处理  come_japan_intro
				$update['learn_japanese_intro'] = trim($this->input->post('learn_japanese_intro'));
				if(!$update['learn_japanese_intro'] || strlen($update['learn_japanese_intro']) > 255){
					$error['learn_japanese_intro'.FORM_ERROR_TAIL] = '请输入学习经历';
				}
			}
		}
		//ever_test_japanese
		$update['ever_test_japanese'] = $this->input->post('ever_test_japanese');
		if(!func::get_const_text('ever_test_japanese',$update['ever_test_japanese'])){
			$error['ever_test_japanese'.FORM_ERROR_TAIL] = '请选择是否考过日语';
		}else{
			if($update['ever_test_japanese'] == 2){//如果没有考试过  以下全部为空
				$update['test_japanese_year'] = '';
				$update['test_japanese_month'] = '';
				$update['test_japanese_name'] = '';
				$update['test_japanese_level'] = 0;
				$update['test_japanese_point'] = 0;
			}else{
				//如果考试过  处理以下变量
				$update['test_japanese_year'] = $this->input->post('test_japanese_year');
				$update['test_japanese_month'] = $this->input->post('test_japanese_month');
				if(!func::check_date($update['test_japanese_year'].'-'.$update['test_japanese_month'].'-01')){
					$error['test_japanses'.FORM_ERROR_TAIL] = '请输入参加日语考试时间';
				}
				//test_japanese_name
				$update['test_japanese_name'] = $this->input->post('test_japanese_name');
				if(!func::get_const_text('test_japanese_name',$update['test_japanese_name'])){
					$error['test_japanese_name'.FORM_ERROR_TAIL] = '请选择参加的考试名称和级别';
				}else{
					//如果考试名称正确，再验证 test_japanese_level
					$update['test_japanese_level'] = $this->input->post('test_japanese_level');
					if(!func::get_const_text('test_japanese_level',
							$update['test_japanese_level'],$update['test_japanese_name'])){
						$error['test_japanese_level'.FORM_ERROR_TAIL] = '请选择参加考试级别';
					}
				}
				//test_japanese_point
				$update['test_japanese_point'] = trim($this->input->post('test_japanese_point'));
				if(!$update['test_japanese_point'] || strlen($update['test_japanese_point']) > 45){
					$error['test_japanese_point'.FORM_ERROR_TAIL] = '请输入日语考试成绩';
				}
			}
		}
		//highschool_name
		$update['highschool_name'] = trim($this->input->post('highschool_name'));
		if(!$update['highschool_name']||strlen($update['highschool_name']) > 45){
			$error['highschool_name'.FORM_ERROR_TAIL] = '请输入高中名称';
		}
		//highschool_type
		$update['highschool_type'] = $this->input->post('highschool_type');
		if(!func::get_const_text('highschool_type',$update['highschool_type'])){
			$error['highschool_type'.FORM_ERROR_TAIL] = '请选择高中类型';
		}
		//highschool_point
		$update['highschool_point'] = trim($this->input->post('highschool_point'));
		if(!$update['highschool_point']||strlen($update['highschool_point']) > 45){
			$error['highschool_point'.FORM_ERROR_TAIL] = '请输入高考成绩';
		}
		//highschool_year  highschool_month
		$update['highschool_year'] = $this->input->post('highschool_year');
		$update['highschool_month'] = $this->input->post('highschool_month');
		if(!func::check_date($update['highschool_year'].'-'.$update['highschool_month'].'-01')){
			$error['highschool_year'.FORM_ERROR_TAIL] = '请选择高考时间';
		}
		/////collage 非必填
		$update['collage_name'] = trim($this->input->post('collage_name'));
		$update['collage_class'] = trim($this->input->post('collage_class'));
		$update['collage_type'] = trim($this->input->post('collage_type'));
		if(!func::get_const_text('collage_type',$update['collage_type'])){
			$update['collage_type'] = 0;
		}
		$update['collage_license'] = trim($this->input->post('collage_license'));
		if(!func::get_const_text('collage_license',$update['collage_license'])){
			$update['collage_license'] = 0;
		}
		$update['collage_year'] = trim($this->input->post('collage_year'));
		$update['collage_month'] = trim($this->input->post('collage_month'));
		//apply_school
		$update['apply_school'] = trim($this->input->post('apply_school'));
		if(!$update['apply_school']||strlen($update['apply_school']) > 45){
			$error['apply_school'.FORM_ERROR_TAIL] = '请输入想要申请的学校名称';
		}
		//apply_year  apply_month
		$update['apply_year'] = $this->input->post('apply_year');
		$update['apply_month'] = $this->input->post('apply_month');
		if(!func::check_date($update['apply_year'].'-'.$update['apply_month'].'-01')){
			$error['apply_year'.FORM_ERROR_TAIL] = '请选择申请入学的时间';
		}
		if($error) exit(FORM_ERROR_PRE.json_encode($error));
		////更新信息
		$update['ut'] = time();
		$update['uer'] = $this->info['admin']['admin_id'];
		$res = $this->sign_model->update_sign($update,$sign_id);
		if($res)exit('1');
		exit('0');	
	}
	
	/*下载*/
	public function download($sign_id = 0){
	$sign_id = intval($sign_id);
	if($sign_id < 1)redirect('mng_sign');
	$sign = $this->sign_model->get_sign_by_id($sign_id);
	if(!$sign)exit('access denied');
	$this->load->library('PHPWord');//load php word
	
	$section = $this->phpword->createSection();
	$font = array('name'=>'Arial','size'=>12);
	$font_title = array('name'=>'Arial','size'=>14,'bold'=>true);
	
	$section->addText('奋斗在日本留学网 调查评估表',$font_title);
	$section->addTextBreak();
	$section->addText('会社电话：03-5822-5520（东京）',$font);
	$section->addTextBreak();
	$section->addText('官方网址： www.fendoujp.com',$font);
	$section->addTextBreak();
	// Define table style arrays
	$styleTable = array('borderSize'=>6, 'borderColor'=>'000', 'cellMargin'=>80);
	$styleFirstRow = array('borderSize'=>6, 'borderColor'=>'000', 'cellMargin'=>80);
	// Define cell style arrays
	$styleCell = array('valign'=>'center','align'=>'center');
	// Add table style
	$this->phpword->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
	// Add table
	$table = $section->addTable('myOwnTableStyle');
	// Add row
	$m = '： ';//冒号
	$table->addRow(400);
	$table->addCell(3200,$styleCell)->addText('姓名'.$m.$sign['name'],$font);
	$table->addCell(3000,$styleCell)->addText('护照'.$m.$sign['passport'],$font);
	$table->addCell(3000,$styleCell)->addText('性别'.$m.func::get_const_text('gender',$sign['gender']),$font);
	$table->addRow(400);
	$table->addCell(3200,$styleCell)->addText('生日'.$m.$sign['birth_year'].'年'.
			$sign['birth_month'].'月'.$sign['birth_day'].'日',$font);
	$table->addCell(3000,$styleCell)->addText('出生地'.$m.$sign['birth_province'].'-'.$sign['birth_city'],$font);
	$table->addCell(3000,$styleCell)->addText('当前状态'.$m.func::get_const_text('apply_status',$sign['apply_status']),$font);
	$table->addRow(400);
	$table->addCell(3200,$styleCell)->addText('户口所在地'.$m.$sign['hukou_province'].'-'.$sign['hukou_city'],$font);
	$table->addCell(6000,$styleCell)->addText('现住址'.$m.$sign['address'],$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('父亲姓名'.$m.$sign['dad_name'].'       年龄'.$m.$sign['dad_age'],$font);
	$table->addCell(4600,$styleCell)->addText('母亲姓名'.$m.$sign['mom_name'].'       年龄'.$m.$sign['mom_age'],$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('经费支付者姓名'.$m.$sign['payer_name'],$font);
	$table->addCell(4600,$styleCell)->addText('经费支付者年收'.$m.$sign['payer_income'],$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('工作单位'.$m.$sign['payer_work'],$font);
	$table->addCell(4600,$styleCell)->addText('与申请人关系'.$m.$sign['payer_relation'],$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('移动电话'.$m.$sign['mobile'],$font);
	$table->addCell(4600,$styleCell)->addText('固定电话'.$m.$sign['telphone'],$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('QQ'.$m.$sign['qq'],$font);
	$table->addCell(4600,$styleCell)->addText('微信'.$m.$sign['wechat'],$font);
	$table->addRow(400);
	$table->addCell(9200,$styleCell)->addText('电子邮件'.$m.$sign['email'],$font);
	$table->addRow(400);
	$table->addCell(3200,$styleCell)->addText('是否来过日本'.$m.func::get_const_text('ever_come_japan',$sign['ever_come_japan']),$font);
	$table->addCell(6000,$styleCell)->addText($sign['come_japan_intro'],$font);
	$table->addRow(400);
	$table->addCell(3200,$styleCell)->addText('是否学过日语'.$m.func::get_const_text('ever_learn_japanese',$sign['ever_learn_japanese']),$font);
	$table->addCell(6000,$styleCell)->addText($sign['learn_japanese_intro'],$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('是否参加过日语考试'.$m.func::get_const_text('ever_test_japanese',$sign['ever_test_japanese']),$font);
	if($sign['ever_test_japanese'] == 1){
		$table->addCell(4600,$styleCell)->addText('考试时间'.$m.$sign['test_japanese_year'].'年'.$sign['test_japanese_month'].'月',$font);
		$table->addRow(400);
		$table->addCell(3200,$styleCell)->addText('考试名称'.$m.func::get_const_text('test_japanese_name',$sign['test_japanese_name']),$font);
		$table->addCell(3000,$styleCell)->addText('考试级别'.$m.func::get_const_text('test_japanese_level',$sign['test_japanese_level'],$sign['test_japanese_name']),$font);
		$table->addCell(3000,$styleCell)->addText('考试成绩'.$m.$sign['test_japanese_point'],$font);
	}else{
		$table->addCell(4600,$styleCell)->addText('',$font);
	}
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('高中名称'.$m.$sign['highschool_name'],$font);
	$table->addCell(4600,$styleCell)->addText('高中类型'.$m.func::get_const_text('highschool_type',$sign['highschool_type']),$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('高考成绩'.$m.$sign['highschool_point'],$font);
	$table->addCell(4600,$styleCell)->addText('毕业时间'.$m.$sign['highschool_year'].'年'.$sign['highschool_month'].'月',$font);
	$table->addRow(400);
	$table->addCell(4600,$styleCell)->addText('大学名称'.$m.$sign['collage_name'],$font);
	$table->addCell(4600,$styleCell)->addText('专业名称'.$m.$sign['collage_class'],$font);
	$table->addRow(400);
	$table->addCell(3200,$styleCell)->addText('毕业时间'.$m.$sign['collage_year'].'年'.$sign['collage_month'].'月',$font);
	$table->addCell(3000,$styleCell)->addText('大学类型'.$m.func::get_const_text('collage_type',$sign['collage_type']),$font);
	$table->addCell(3000,$styleCell)->addText('是否有学位'.$m.func::get_const_text('collage_license',$sign['collage_license']),$font);
	$table->addRow(400);
	$table->addCell(9200,$styleCell)->addText('希望申请的学校'.$m.$sign['apply_school'],$font);
	$table->addRow(400);
	$table->addCell(9200,$styleCell)->addText('希望入学时间'.$m.$sign['apply_year'].'年'.$sign['apply_month'].'月',$font);
	
	$objWriter = PHPWord_IOFactory::createWriter($this->phpword, 'Word2007');
	header("Content-Type: application/doc");
	header("Content-Disposition: attachment; filename=".$sign['name'].date(DATE_YMD,$sign['ct']).".doc");
	$objWriter->save('php://output');
	
	}
	
}


	
	