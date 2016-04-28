<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-13 14:08:22
         compiled from "E:\www\svn\www.ice.com\trunk\application\views\admin\main\login.html" */ ?>
<?php /*%%SmartyHeaderCode:4969557bc8d69faff9-81562341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6697102e4784c376664a10521fe6e6da0c40276c' => 
    array (
      0 => 'E:\\www\\svn\\www.ice.com\\trunk\\application\\views\\admin\\main\\login.html',
      1 => 1429165330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4969557bc8d69faff9-81562341',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web_title' => 0,
    'admin_app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557bc8d6a31b02_59496963',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557bc8d6a31b02_59496963')) {function content_557bc8d6a31b02_59496963($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<body>
<div align="center">
<div style="margin:10px 0 15% 0;"></div>
	<h2><?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
后台管理</h2>
	<div class="easyui-panel" title="登录" style="width:400px;padding:10px 60px 20px 60px">
		<table cellpadding="5">
			<tr><td colspan="2" height="20"></td></tr>
			<tr>
				<td>用户名:</td>
				<td><input class="easyui-validatebox textbox" id="username" data-options="required:true,validType:'length[3,10]',novalidate:true"></td>
			</tr>
			<tr>
				<td>密&nbsp;&nbsp;码:</td>
				<td><input class="easyui-validatebox textbox" id="password" type="password" data-options="required:true,novalidate:true"></td>
			</tr>
			<tr><td colspan="2" height="20"></td></tr>
			<tr>
				<td colspan="2"><div align="center">
            	<a href="javascript:;" class="easyui-linkbutton" id="btn_admin_login" style="width:100px">登录</a>
          		</div></td>
			</tr>
		</table>
	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	$('.validatebox-text').bind('blur', function(){
		$(this).validatebox('enableValidation').validatebox('validate');
	});
	$("#btn_admin_login").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		if(isEmptyVal(username)){
			msg_box_show('请输入帐号!',2,'','warning','username');
			return false;
		}
		if(isEmptyVal(password)){
			msg_box_show('请输入密码!',2,'','warning','password');
			return false;
		}
	    ajax_post("/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/login.html",{username:username,password:password},"/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/index.html");
   });
})
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
