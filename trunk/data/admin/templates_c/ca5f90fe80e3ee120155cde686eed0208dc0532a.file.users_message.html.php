<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-12 13:03:07
         compiled from "E:\www\svn\www.ice.com\trunk\application\views\admin\main\users_message.html" */ ?>
<?php /*%%SmartyHeaderCode:31917557a66435f5b70-64023643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca5f90fe80e3ee120155cde686eed0208dc0532a' => 
    array (
      0 => 'E:\\www\\svn\\www.ice.com\\trunk\\application\\views\\admin\\main\\users_message.html',
      1 => 1434085244,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31917557a66435f5b70-64023643',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557a6643672b89_49280678',
  'variables' => 
  array (
    'admin_app' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a6643672b89_49280678')) {function content_557a6643672b89_49280678($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<body>
	<table id="dg" class="easyui-datagrid" title="客户留言" style="width:100%;height:auto"
			data-options="
				rownumbers:true,singleSelect:true,pagination:true,pageSize:20,
				queryParams: {'action':'all'},
				iconCls: 'icon-save',
				toolbar: '#tb',
				url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/users-message.html',
				method: 'post',
				onClickRow: onClickRow
			">
		<thead>
			<tr>
				<th data-options="field:'id',width:40">ID</th>
				<th data-options="field:'username',width:130">登录帐号</th>
				<th data-options="field:'email',width:150">电子邮箱</th>
				<th data-options="field:'content',width:500">留言内容</th>
				<th data-options="field:'addtime',width:130">留言时间</th>
			</tr>
		</thead>
	</table>
</body>
</html><?php }} ?>
