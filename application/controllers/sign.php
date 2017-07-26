<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 联系我们
 * MyDivine2016-10-15
 */

class sign extends UC{
	
	//构造方法	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->info['page_title'] = '在线申请报名';
		$this->info['page_sub_title'] = 'Sign Apply';
		$token = time().rand(10000,99999);
		$_SESSION[SESSION_NAME.'sign_token'] = $token;
		$this->info['token'] = $token;
		$this->v();
	}
	
	public function save(){
		////token--防止机器人提交--////
		$token = $this->input->post('token');
		if($token != $_SESSION[SESSION_NAME.'sign_token'] || !$token){
			exit(json_encode(array('token'=>1)));
		}
		////获取参数+验证参数
		$error = array();
		$create = array();
		//name
		$create['name'] = trim($this->input->post('name'));
		if(!$create['name'] || strlen($create['name']) > 45)$error['name'] = 1;
		//passport
		$create['passport'] = trim($this->input->post('passport'));
		if(!$create['passport'] || strlen($create['passport']) > 45)$error['passport'] = 1;
		//gender
		$create['gender'] = $this->input->post('gender');
		if(!func::get_const_text('gender',$create['gender']))$error['gender'] = 1;
		//apply_status
		$create['apply_status'] = $this->input->post('apply_status');
		if(!func::get_const_text('apply_status',$create['apply_status']))$error['apply_status'] = 1;
		//年月日
		$create['birth_year'] = $this->input->post('birth_year');
		$create['birth_month'] = $this->input->post('birth_month');
		$create['birth_day'] = $this->input->post('birth_day');
		if(!func::check_date($create['birth_year'].'-'.$create['birth_month'].'-'.$create['birth_day'])){
			$error['birth_year'] = 1;$error['birth_month'] = 1;$error['birth_day'] = 1;
		}
		//birth_province
		$create['birth_province'] = trim($this->input->post('birth_province'));
		if(!$create['birth_province'] || strlen($create['birth_province']) > 45)$error['birth_province'] = 1;
		//birth_city
		$create['birth_city'] = trim($this->input->post('birth_city'));
		if(!$create['birth_city'] || strlen($create['birth_city']) > 45)$error['birth_city'] = 1;
		//hukou_province
		$create['hukou_province'] = trim($this->input->post('hukou_province'));
		if(!$create['hukou_province'] || strlen($create['hukou_province']) > 45)$error['hukou_province'] = 1;
		//hukou_city
		$create['hukou_city'] = trim($this->input->post('hukou_city'));
		if(!$create['hukou_city'] || strlen($create['hukou_city']) > 45)$error['hukou_city'] = 1;
		//address
		$create['address'] = trim($this->input->post('address'));
		if(!$create['address'] || strlen($create['address']) > 255)$error['address'] = 1;
		//dad_name
		$create['dad_name'] = trim($this->input->post('dad_name'));
		if(!$create['dad_name'] || strlen($create['dad_name']) > 45)$error['dad_name'] = 1;
		//dad_age
		$create['dad_age'] = intval($this->input->post('dad_age'));
		if(!$create['dad_age'] || $create['dad_age'] < 1)$error['dad_age'] = 1;
		//mom_name
		$create['mom_name'] = trim($this->input->post('mom_name'));
		if(!$create['mom_name'] || strlen($create['mom_name']) > 45)$error['mom_name'] = 1;
		//mom_age
		$create['mom_age'] = intval($this->input->post('mom_age'));
		if(!$create['mom_age'] || $create['mom_age'] < 1)$error['mom_age'] = 1;
		//payer_name
		$create['payer_name'] = trim($this->input->post('payer_name'));
		if(!$create['payer_name'] || strlen($create['payer_name']) > 45)$error['payer_name'] = 1;
		//payer_relation
		$create['payer_relation'] = trim($this->input->post('payer_relation'));
		if(!$create['payer_relation']||strlen($create['payer_relation']) > 45)$error['payer_relation'] = 1;
		//payer_work
		$create['payer_work'] = trim($this->input->post('payer_work'));
		if(!$create['payer_work'] || strlen($create['payer_work']) > 255)$error['payer_work'] = 1;
		//经费支付人年收
		$create['payer_income'] = trim($this->input->post('payer_income'));
		if(!$create['payer_income']||strlen($create['payer_income']) > 45)$error['payer_income'] = 1;
		//mobile
		$create['mobile'] = trim($this->input->post('mobile'));
		if(!$create['mobile'] || strlen($create['mobile']) > 45)$error['mobile'] = 1;
		//telphone
		$create['telphone'] = trim($this->input->post('telphone'));
		if(!$create['telphone'] || strlen($create['telphone']) > 45)$error['telphone'] = 1;
		//wechat
		$create['wechat'] = trim($this->input->post('wechat'));
		if(!$create['wechat'] || strlen($create['wechat']) > 45)$error['wechat'] = 1;
		//qq
		$create['qq'] = trim($this->input->post('qq'));
		if(!$create['qq'] || strlen($create['qq']) > 45)$error['qq'] = 1;
		//email
		$create['email'] = trim($this->input->post('email'));
		if(!$create['email']||strlen($create['email'])>45||!strpos($create['email'],'@'))$error['email'] = 1;
		//ever_come_japan
		$create['ever_come_japan'] = $this->input->post('ever_come_japan');
		if(!func::get_const_text('ever_come_japan',$create['ever_come_japan'])){
			$error['ever_come_japan'] = 1;
		}else{
			if($create['ever_come_japan'] == 2){
				$create['come_japan_intro'] = '';//如果没来过 这里直接为空
			}else{
				//如果来过  处理  come_japan_intro
				$create['come_japan_intro'] = trim($this->input->post('come_japan_intro'));
				if(!$create['come_japan_intro'] || strlen($create['come_japan_intro']) > 255){
					$error['come_japan_intro'] = 1;
				}
			}
		}
		//ever_learn_japanese
		$create['ever_learn_japanese'] = $this->input->post('ever_learn_japanese');
		if(!func::get_const_text('ever_learn_japanese',$create['ever_learn_japanese'])){
			$error['ever_learn_japanese'] = 1;
		}else{
			if($create['ever_learn_japanese'] == 2){
				$create['learn_japanese_intro'] = '';//如果没学过 这里直接为空
			}else{
				//如果学过  处理  come_japan_intro
				$create['learn_japanese_intro'] = trim($this->input->post('learn_japanese_intro'));
				if(!$create['learn_japanese_intro'] || strlen($create['learn_japanese_intro']) > 255){
					$error['learn_japanese_intro'] = 1;
				}
			}
		}
		//ever_test_japanese
		$create['ever_test_japanese'] = $this->input->post('ever_test_japanese');
		if(!func::get_const_text('ever_test_japanese',$create['ever_test_japanese'])){
			$error['ever_test_japanese'] = 1;
		}else{
			if($create['ever_test_japanese'] == 2){//如果没有考试过  以下全部为空
				$create['test_japanese_year'] = '';
				$create['test_japanese_month'] = '';
				$create['test_japanese_name'] = '';
				$create['test_japanese_level'] = 0;
				$create['test_japanese_point'] = 0;
			}else{
				//如果考试过  处理以下变量
				$create['test_japanese_year'] = $this->input->post('test_japanese_year');
				$create['test_japanese_month'] = $this->input->post('test_japanese_month');
				if(!func::check_date($create['test_japanese_year'].'-'.$create['test_japanese_month'].'-01')){
					$error['test_japanese_year'] = 1;$error['test_japanese_month'] = 1;
				}
				//test_japanese_name
				$create['test_japanese_name'] = $this->input->post('test_japanese_name');
				if(!func::get_const_text('test_japanese_name',$create['test_japanese_name'])){
					$error['test_japanese_name'] = 1;
					$error['test_japanese_level'] = 1;
				}else{
					//如果考试名称正确，再验证 test_japanese_level
					$create['test_japanese_level'] = $this->input->post('test_japanese_level');
					if(!func::get_const_text('test_japanese_level',
						$create['test_japanese_level'],$create['test_japanese_name'])){
						$error['test_japanese_level'] = 1;
					}
				}
				//test_japanese_point
				$create['test_japanese_point'] = trim($this->input->post('test_japanese_point'));
				if(!$create['test_japanese_point'] || strlen($create['test_japanese_point']) > 45){
					$error['test_japanese_point'] = 1;
				}
			}
		}
		//highschool_name
		$create['highschool_name'] = trim($this->input->post('highschool_name'));
		if(!$create['highschool_name']||strlen($create['highschool_name']) > 45)$error['highschool_name'] = 1;
		//highschool_type
		$create['highschool_type'] = $this->input->post('highschool_type');
		if(!func::get_const_text('highschool_type',$create['highschool_type']))$error['highschool_type'] = 1;
		//highschool_point
		$create['highschool_point'] = trim($this->input->post('highschool_point'));
		if(!$create['highschool_point']||strlen($create['highschool_point']) > 45)$error['highschool_point'] = 1;
		//highschool_year  highschool_month
		$create['highschool_year'] = $this->input->post('highschool_year');
		$create['highschool_month'] = $this->input->post('highschool_month');
		if(!func::check_date($create['highschool_year'].'-'.$create['highschool_month'].'-01')){
			$error['highschool_year'] = 1;$error['highschool_month'] = 1;
		}
		/////collage 非必填
		$create['collage_name'] = trim($this->input->post('collage_name'));
		$create['collage_class'] = trim($this->input->post('collage_class'));
		$create['collage_type'] = trim($this->input->post('collage_type'));
		if(!func::get_const_text('collage_type',$create['collage_type'])){
			$create['collage_type'] = 0;
		}
		$create['collage_license'] = trim($this->input->post('collage_license'));
		if(!func::get_const_text('collage_license',$create['collage_license'])){
			$create['collage_license'] = 0;
		}
		$create['collage_year'] = trim($this->input->post('collage_year'));
		$create['collage_month'] = trim($this->input->post('collage_month'));
		//apply_school
		$create['apply_school'] = trim($this->input->post('apply_school'));
		if(!$create['apply_school']||strlen($create['apply_school']) > 45)$error['apply_school'] = 1;
		//apply_year  apply_month
		$create['apply_year'] = $this->input->post('apply_year');
		$create['apply_month'] = $this->input->post('apply_month');
		if(!func::check_date($create['apply_year'].'-'.$create['apply_month'].'-01')){
			$error['apply_year'] = 1;$error['apply_month'] = 1;
		}
		if($error) exit(json_encode($error));
		
		$create['ip'] = $_SERVER["REMOTE_ADDR"];//ip地址
		$create['ct'] = time();//时间戳
		$create['status'] = 1;//状态 1=未对应  2=对应中 3=成功 4=失败 5=被删除
		//model执行插入
		$this->load->model('sign_model');
		if($this->sign_model->create_sign($create)){
			$_SESSION[SESSION_NAME.'sign_token'] = '';//销毁session
			exit('success');
		}
		exit('fail');	
	}
}