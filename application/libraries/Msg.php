<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * 发短信类
*/

class Msg {

	private $username = '';//用户名
	private $password = '';//密码
	private $url = '';//url
	private $sign = '';//签名
	
	public function __construct(){
 		//获取系统框架副本
 		$ci =& get_instance(); 		 		
 		$ci->load->config('msg');
 		$config = $ci->config->item('msg_config');	
		$this->username = $config['username'];
		$this->password = $config['password'];
		$this->url = $config['send_url'];
		$this->sign = $config['sign'];
	}
	//发短信
	//type = 1->自由编辑的短信
	//       2->申请验证码通过
	//       3->注册验证码
	//       4->找回密码
	//       5->修改手机
	//       6->提现
	//       7->直邮订单付款成功
	//       8->订单马上取消
	//       9->发货
	//       10->提现通过
	//       11->提现不通过
	//       12->退货受理
	//       13->退货通过
	//       14->提交邀请码申请通过
	//       15->提交找货助手
	//       16->用户邀请
	//       17->付款后取消订单
	//       18->缺货登记
	//       19->活动结束
	//其他   = 各种事件 现在还没有
	public function send($type = 1,$content = '',$receiver = ''){
		$url = $this->url.'?u='.$this->username.'&p='.$this->password.'&c='.$this->sign;
		//自由短信
		if($type == 1){
			$content = urlencode($content);	
		//申请验证码通过		
		}else if($type == 2){
			//【海买客】恭喜您！申请已通过，注册码：{code}，请直接到海买客官网注册
			$origin = '恭喜您！申请已通过，注册码：';
			$origin2 = '，请直接到海买客官网注册';
			$content = urlencode($origin.$content.$origin2);
		//注册验证码
		}else if($type == 3){
			$origin = '（海买客平台验证码，30分钟内有效），请输入后进行验证，谢谢！';
			$content = urlencode($content.$origin);
		}else if($type == 4){
			$origin = '（海买客平台验证码，30分钟内有效），请输入后进行验证，谢谢！';
			$content = urlencode($content.$origin);
		}else if($type == 5){
			$origin = '（海买客平台验证码，30分钟内有效），请输入后进行验证，谢谢！';
			$content = urlencode($content.$origin);
		}else if($type == 6){
			$origin = '(提现申请验证码，30分钟内有效），如非本人操作，请及时联系客服工作人员！';
			$content = urlencode($content.$origin);
		}else if($type == 7){
			//【海买客】本次购物您新增海买币{当时比例计算}，将在确认收货后7个工作日发放到您的账户，请您耐心等待，当前海买币总额{当时海买币总额}，登录我的海买客查看
			$tmp =  '本次购物您新增海买币';
			$tmp .= $content['point'];
			$tmp .= '，将在确认收货后7个工作日发放到您的账户，请您耐心等待，当前海买币总额';
			$tmp .= $content['point_total'];
			$tmp .= '，登录我的海买客查看';
			$content = $tmp;
			$content = urlencode($content);
		}else if($type==8){
			//【海买客】您辛苦创建的订单已为您保留时间超过20分钟，还有10分钟支付时间，因库存紧张宝贝可能被人抢走，海买客提醒您尽快支付
			$content = '您辛苦创建的订单已为您保留时间超过20分钟，还有10分钟支付时间，因库存紧张宝贝可能被人抢走，海买客提醒您尽快支付';
			$content = urlencode($content);
		}else if($type == 9){
			//【海买客】嗨！您的订单已从澳洲库房发出，由国际快递公司进行配送，您可以登录我的海买客查看详情，或咨询客服400-155-1788。
			//【海买客】嗨！您的订单已从{location}库房发出，由国际快递公司进行配送，您可以登录我的海买客查看详情，或咨询客服400-155-1788。
			//$content = '嗨！您的订单已从澳洲库房发出，由国际快递公司进行配送，您可以登录我的海买客查看详情，或咨询客服400-155-1788。';
			$tmp = '嗨！您的订单已从';
			$tmp .= $content;
			$tmp .= '库房发出，由国际快递公司进行配送，您可以登录我的海买客查看详情，或咨询客服400-155-1788。';
			$content = $tmp;
			$content = urlencode($content);
		}else if($type == 10){
			//【海买客】您的提现申请已审核通过，系统将在3-4个工作日为您汇款（具体到账以银行、支付宝时间为准），我们始终坚信只要付出终会有回报！
			$content = '您的提现申请已审核通过，系统将在3-4个工作日为您汇款（具体到账以银行、支付宝时间为准），我们始终坚信只要付出终会有回报！';
			$content = urlencode($content);
		}else if($type == 11){
			//【海买客】您的提现申请失败！海买币已退还到您账户，原因可能是您填写的提现账户信息有误，请重新申请或咨询客服400-155-1788
			$content = '您的提现申请失败！海买币已退还到您账户，原因可能是您填写的提现账户信息有误，请重新申请或咨询客服400-155-1788';
			$content = urlencode($content);
		}else if($type == 12){
			//【海买客】您的退货申请已通过，请将商品、票据及包装 发往北京市朝阳区望京SOHO塔1 B区 301室，收货人冯静静，电话18600862570，邮编100102，并在运单号上注明订单号（注：勿用EMS、顺丰、邮政包裹及到付方式）。收到货7日内商品因包装及质量问题等原因办理退换货产生的运费，将返还到您的海买币账户中。
			$content = '您的退货申请已通过，请将商品、票据及包装发往北京市朝阳区望京SOHO塔1，B区，301室，收货人冯静静，电话18600862570，邮编100102，并在运单号上注明订单号（注：勿用EMS、顺丰、邮政包裹及到付方式）。收到货7日内商品因包装及质量问题等原因办理退换货产生的运费，将返还到您的海买币账户中。';			
			$content = urlencode($content);
		}else if($type == 13){
			//【海买客】尊敬的用户，您好！您的订单号为{trade_no}的商品退货已受理成功，退款将在3-5个工作日后退回您的支付宝/财付通/银行账号。请注意查收。
			$tmp = '尊敬的用户，您好！您的订单号为';
			$tmp .= $content;
			$tmp .= '的商品退货已受理成功，退款将在3-5个工作日后退回您的支付宝/财付通/银行账号。请注意查收。';
			$content = $tmp;
			$content = urlencode($content);
		}else if($type == 14){
			//【海买客】尊敬的用户，您的申请我们已收到！我们将在24小时内给您回复，非常感谢您的支持，客服电话400-155-1788
			$content = '尊敬的用户，您的申请我们已收到！我们将在24小时内给您回复，非常感谢您的支持，客服电话400-155-1788';
			$content = urlencode($content);
		}else if($type == 15){
			//【海买客】非常感谢您留言，稍后大客户经理冯静静会与您取得联系，电话：18600862570，请您保持手机畅通
			$content = '非常感谢您留言，稍后大客户经理冯静静会与您取得联系，电话：18600862570，请您保持手机畅通';
			$content = urlencode($content);
		}else if($type == 16){
			//【海买客】来自海买客{mobile}；注册码：{code}，请直接到海买客官网注册
			$tmp = '来自海买客'.$content['mobile'].'；注册码：'.$content['code'].'，请直接到海买客官网注册';
			$content = $tmp;
			$content = urlencode($content);
		}else if($type == 17){
			//【海买客】尊敬的用户，您好！您的订单号为{trade_no}已取消，退款将在3-5个工作日后退回您的支付宝/财付通/银行账号。请注意查收！
			$tmp = '尊敬的用户，您好！您的订单号为';
			$tmp .= $content;
			$tmp .= '已取消，退款将在3-5个工作日后退回您的支付宝/财付通/银行账号。请注意查收！';
			$content = $tmp;
			$content = urlencode($content);
		}else if($type == 18){
			//【海买客】尊敬的用户，您好！您添加到货提醒中的商品{name}已到货，数量不多！请您尽快登录海买客进行购买。
			$tmp = '尊敬的用户，您好！您添加到货提醒中的商品';
			$tmp .= $content;
			$tmp .= '已到货，数量不多！请您尽快登录海买客进行购买。';
			$content = $tmp;
			$content = urlencode($content);
		}else if($type == 19){
			//恭喜您！，本次活动获得{number}个海买币，请您登录我的海买客进行查看详情。
			$tmp = '恭喜您！，本次活动获得';
			$tmp .= $content;
			$tmp .= '个海买币，请您登录我的海买客进行查看详情。';
			$content = $tmp;
			$content = urlencode($content);
		}else{
			return 'type error';
		}
				
		$url = $url.$content.'&m='.$receiver;
		
		if($type == 1){
			return file_get_contents($url);
		}else{
			$return = array();
			$return['result'] = file_get_contents($url);
			$return['content'] = urldecode($content);
			return $return;
		}
	}
	
}