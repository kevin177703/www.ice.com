<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-13 14:10:04
         compiled from "E:\www\svn\www.ice.com\trunk\application\views\admin\main\users_list.html" */ ?>
<?php /*%%SmartyHeaderCode:12804557a655f063d31-87069065%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ea4dddfffbf7a0e8a6fcd8975b6f7632c54f26a' => 
    array (
      0 => 'E:\\www\\svn\\www.ice.com\\trunk\\application\\views\\admin\\main\\users_list.html',
      1 => 1434175784,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12804557a655f063d31-87069065',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557a655f0f45d2_55795840',
  'variables' => 
  array (
    'admin_app' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a655f0f45d2_55795840')) {function content_557a655f0f45d2_55795840($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<body>
	<table id="dg" class="easyui-datagrid" title="会员列表" style="width:100%;height:auto"
			data-options="
				rownumbers:true,singleSelect:true,pagination:true,pageSize:20,
				queryParams: {'action':'all'},
				iconCls: 'icon-save',
				toolbar: '#tb',
				url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/users-list.html',
				method: 'post',
				onClickRow: onClickRow
			">
		<thead>
			<tr>
				<th data-options="field:'uid',width:40">ID</th>
				<th data-options="field:'email',width:150">电子邮箱</th>
				<th data-options="field:'registertime',width:130">注册时间</th>
				<th data-options="field:'logintime',width:130">最后登录时间</th>
				<th data-options="field:'status',width:130">状态(Y正常/N禁用)</th>
			</tr>
		</thead>
	</table>
	<div id="tb" style="padding:2px 0">
		<table cellpadding="0" cellspacing="0" style="width:100%">
			<tr>
				<td style="padding-left:2px">
					<a href="javascript:void(0);" id="btn_add" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true">添加</a>
					<a href="javascript:void(0);" id="btn_edit" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true">编辑</a>
					<a href="javascript:void(0);" id="btn_remove" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true">删除</a>
				</td>
				<td style="text-align:right;padding-right:2px">
					<input id="search" class="easyui-searchbox" data-options="prompt:'输入会员email'" style="width:250px"></input>
				</td>
			</tr>
		</table>
	</div>
	<div id="dlg" class="easyui-dialog" title="设置会员" style="width:400px;height:auto;padding:10px"
			data-options="
				iconCls: 'icon-edit',
				buttons: '#dlg-buttons'
			">
		<table cellpadding="5">
			<tr>
				<td>电子邮箱:</td>
				<td><input id="email" class="easyui-validatebox textbox" data-options="novalidate:true"></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input id="password" type="password" class="easyui-validatebox textbox" data-options="novalidate:true"></td>
			</tr>
			<tr>
				<td>密码确认:</td>
				<td><input id="cpassword" type="password" class="easyui-validatebox textbox" data-options="novalidate:true"></td>
			</tr>
			<tr id="status">
				<td>是否禁用:</td>
				<td>
				<input type="hidden" id="hstatus" value="Y" />
				<input type="radio" id="yes" name="status" value="Y" checked="checked"><span>启用</span>
				<input type="radio" id="no" name="status" value="N"><span>禁用</span>
				</td>
			</tr>
		</table>
	</div>
	<div id="dlg-buttons">
		<input type="hidden" id="uid" value="0" />
		<a href="javascript:void(0)" class="easyui-linkbutton" id="btn_save">保存</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#dlg').dialog('close')">取消</a>
	</div>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	$('#dlg').dialog('close');
	$('#dlg_undo').dialog('close');
	$('.validatebox-text').bind('blur', function(){
		$(this).validatebox('enableValidation').validatebox('validate');
	});
	$("#search").searchbox({
	    searcher: function (val, name) {
	        $('#dg').datagrid('options').queryParams.search = val;
	        $('#dg').datagrid('reload');
	    },
	    prompt: '输入会员email'
	});
	$("#btn_save").click(function(){
		var uid = $("#uid").val();
		var password = $("#password").val();
		var cpassword = $("#cpassword").val();
		var email = $("#email").val();
		var status = $("#hstatus").val();
		
		if(isEmptyVal(email)){
			message('请输入Email','warning');
			return false;
		}
		if(uid==0 && isEmptyVal(password)){
			message('请输入登录密码','warning');
			return false;
		}
		if(password!=cpassword){
			message('两次密码不一致','warning');
			return false;
		}
		
		$.ajax({   
	        type: 'POST', 
	        url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/users-list.html',   
	        data: {
	        	action:'save',
	        	uid:uid,
	        	password:password,
	        	cpassword:cpassword,
	        	email:email,
	        	status:status
	        },
	        dataType:'json',
	        beforeSend:function(){
	        	wait_open();
	        },		    
	        complete: function() {   
	        	wait_close();
	        },   
	        success: function(data){
				if(data.result==true){	
					message('保存成功','info');
					$('#dlg').dialog('close');
					$('#dg').datagrid('reload');
				}else {
					message(data.msg,'error');
			    }               
	        }   
		});
	});
	$("#btn_add").click(function(){
		$("#uid").val(0);
		$("#password").val("");
		$("#cpassword").val("");
		$("#email").val("");
		$('#dlg').dialog('open');
	});
	$("#btn_edit").click(function(){
		if (editIndex == undefined)return false;
		var row = $("#dg").datagrid("getSelected");
		var uid = row.uid;
		$.ajax({   
	        type: 'POST', 
	        url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/users-list.html',   
	        data: {action:'one',uid:uid},
	        dataType:'json',
	        beforeSend:function(){
	        	wait_open();
	        },		    
	        complete: function() {   
	        	wait_close();
	        },   
	        success: function(data){
				if(data.result==true){
					var data = data.data;
					$("#uid").val(data.uid);
					$("#password").val("");
					$("#cpassword").val("");
					$("#email").val(data.email);
					$("#hstatus").val(data.status);
					$("#pass_msg").html("若不修改，留空");
					if(data.status=='Y'){
						$('input[name=status]').get(0).checked = true;
					}else{
						$('input[name=status]').get(1).checked = true;
					}
					$('#dlg').dialog('open');
				}else {
				    message('获取数据失败','warning');
			    }               
	        }   
		});
	});
	$("#btn_remove").click(function(){
		if (editIndex == undefined)return false;
		var row = $("#dg").datagrid("getSelected");
		var uid = row.uid;
		var email = row.email;
		$.messager.confirm('删除确认', '是否确认删除帐号'+email+'?', function(r){
			if (r){
				$.ajax({   
			        type: 'POST', 
			        url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/users-list.html',   
			        data: {action:'del',uid:uid},
			        dataType:'json',
			        beforeSend:function(){
			        	wait_open();
			        },		    
			        complete: function() {   
			        	wait_close();
			        },  
			        success: function(data){
			        	if(data.result==true){
			        		deleteRow();
			        		message('删除成功','info');
			        		$('#dg').datagrid('reload');
						}else {
						    message(data.msg,'warning');
					    }               
			        }   
				});
			}
			return false;
		});
	});
	$('#status input').click(function(){
		var v = $(this).val();
		$("#hstatus").val(v);
	});
})
<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
