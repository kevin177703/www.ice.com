<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-13 08:30:35
         compiled from "E:\www\www.ice.com\trunk\application\views\admin\header.html" */ ?>
<?php /*%%SmartyHeaderCode:3285557b79ab5e3b04-04038787%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a89f6d11fb4b77f63ace9230ecbc2d9e911ba60c' => 
    array (
      0 => 'E:\\www\\www.ice.com\\trunk\\application\\views\\admin\\header.html',
      1 => 1427442773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3285557b79ab5e3b04-04038787',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web_title' => 0,
    'third' => 0,
    'css' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557b79ab606d94_93792287',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557b79ab606d94_93792287')) {function content_557b79ab606d94_93792287($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
admin/style.css">
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
jquery/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="http://img1.gbstatic.com/js/artDialog/jquery.artDialog.js?skin=default"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
jquery/jquery.blockUI.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
/easyui/jquery.easyui.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
/easyui/locale/easyui-lang-zh_CN.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
common.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
admin/common.js"><?php echo '</script'; ?>
>
</head><?php }} ?>
