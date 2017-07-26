<?php 

//登录模块表单错误提示
$form_error_msg = array();

$form_error_msg['login_token_error'] = '网页已过期，请刷新后重试';
$form_error_msg['check_error'] = '账号或密码不正确';
$form_error_msg['empty'] = '请输入账号和密码';
$form_error_msg['admin_valid'] = '该账号已被禁用';


$config['form_error_msg'] = $form_error_msg;
