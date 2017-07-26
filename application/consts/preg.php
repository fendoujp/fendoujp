<?php
//常用正则类

class preg{
	
	const MOBILE_AREA = '/^[0-9]{1,3}$/'; //国际区号
	const MOBILE_CHINA = '/^1{1}[0-9]{10}$/';  //正则手机号-中国
	const MOBILE = '/^[0-9]{11}$/';//其他国家正则手机号
	const MAIL = '/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/';  //正则邮箱
	const BANNER_ORDER = '/^[0-9]{1,3}$/';//广告排序值
	const LAYOUT_ORDER = '/^[0-9]{1,3}$/';//楼层排序值
	const LINK_ORDER = '/^[0-9]{1,3}$/';//合作品牌排序
	const BRAND_ORDER = '/^[0-9]{1,8}$/';//品牌排序值
	const ITEM_ORDER = '/^[0-9]{1,8}$/';//商品排序值
	const ITEM_LOWEST_BUY = '/^[0-9]{1,8}$/';//商品最低起订
	const PRICE = '/^[0-9]{1,8}[.]{1}[0-9]{1}[0-9]{1}$/';//价格
	const BANK_ACCOUNT = '/^(\d{16}|\d{19}|\d{18})$/';//银行账号
	const POINT = '/^[0-9]|[1-9]{1}[0-9]{1,8}$/';//积分
	const IDCARD = '/^\d{17}(\d|x)$/i';//身份证
}