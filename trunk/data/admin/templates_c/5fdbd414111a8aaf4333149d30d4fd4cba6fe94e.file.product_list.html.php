<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-13 22:25:24
         compiled from "E:\www\www.ice.com\trunk\application\views\admin\main\product_list.html" */ ?>
<?php /*%%SmartyHeaderCode:1829557b7c1bd1f795-07469244%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fdbd414111a8aaf4333149d30d4fd4cba6fe94e' => 
    array (
      0 => 'E:\\www\\www.ice.com\\trunk\\application\\views\\admin\\main\\product_list.html',
      1 => 1434205520,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1829557b7c1bd1f795-07469244',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557b7c1bd7d3a9_11457844',
  'variables' => 
  array (
    'third' => 0,
    'admin_app' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557b7c1bd7d3a9_11457844')) {function content_557b7c1bd7d3a9_11457844($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
kindeditor/themes/default/default.css">
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
kindeditor/kindeditor-min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
kindeditor/lang/zh_CN.js"><?php echo '</script'; ?>
>
<body>
	<table id="dg" class="easyui-datagrid" title="商品列表" style="width:100%;height:auto"
			data-options="
				rownumbers:true,singleSelect:true,pagination:true,pageSize:20,
				queryParams: {'action':'all'},
				iconCls: 'icon-save',
				toolbar: '#tb',
				url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/product-list.html',
				method: 'post',
				onClickRow: onClickRow
			">
		<thead>
			<tr>
				<th data-options="field:'id',width:40">ID</th>
				<th data-options="field:'name',width:250">商品名称</th>
				<th data-options="field:'type',width:150">商品类别</th>
				<th data-options="field:'price',width:150">商品价格</th>
				<th data-options="field:'rebate',width:100">商品折扣%</th>
				<th data-options="field:'stock',width:100">库存</th>
				<th data-options="field:'status',width:150">状态(Y正常/N下架)</th>
			</tr>
		</thead>
	</table>
	<div id="tb" style="padding:2px 0">
		<table cellpadding="0" cellspacing="0" style="width:100%">
			<tr>
				<td style="padding-left:2px">
					<a href="javascript:void(0);" id="btn_sel" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true">查看</a>
					<a href="javascript:void(0);" id="btn_add" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true">添加</a>
					<a href="javascript:void(0);" id="btn_edit" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true">编辑</a>
					<a href="javascript:void(0);" id="btn_remove" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true">删除</a>
				</td>
				<td style="text-align:right;padding-right:2px">
					<input id="search" class="easyui-searchbox" data-options="prompt:'输入商品名称'" style="width:250px"></input>
				</td>
			</tr>
		</table>
	</div>
	<div id="dlg" class="easyui-dialog" title="设置会员" style="width:1024px;height:auto;padding:10px"
			data-options="
				iconCls: 'icon-edit',
				buttons: '#dlg-buttons'
			">
		<table cellpadding="5">
			<tr>
				<td>商品名称:</td>
				<td><input id="name" class="easyui-validatebox textbox" style="width:300px;" data-options="required:true,novalidate:true"></td>
			</tr>
			<tr>
				<td>商品描述:</td>
				<td><textarea id="describe" name="describe" style="width:800px;height:250px;visibility:hidden;"></textarea></td>
			</tr>
			<tr>
				<td>商品类型:</td>
				<td>
					<input type="hidden" id="htype" value="0" />
					<input class="easyui-combobox" id="type" 
						data-options="valueField:'id',textField:'name'">
				</td>
			</tr>
			<tr>
				<td>价格:</td>
				<td><input id="price" class="easyui-validatebox textbox" style="width:120px;" data-options="required:true,novalidate:true"></td>
			</tr>
			<tr>
				<td>折扣:</td>
				<td><input id="rebate" class="easyui-validatebox textbox" style="width:120px;" data-options="required:true,novalidate:true">%</td>
			</tr>
			<tr>
				<td>库存:</td>
				<td><input id="stock" class="easyui-validatebox textbox" style="width:120px;" data-options="required:true,novalidate:true"></td>
			</tr>
			<tr>
				<td>商品图片:</td>
				<td><input type="text" id="url" value="" class="easyui-validatebox textbox" style="width:360px;" /> 
				<a href="javascript:;" id="image" class="easyui-linkbutton" data-options="iconCls:'icon-add'">选择图片</a></td>
			</tr>
			<tr id="status">
				<td>是否已下架:</td>
				<td>
				<input type="hidden" id="hstatus" value="Y" />
				<input type="radio" id="yes" name="status" value="Y" checked="checked"><span>正常</span>
				<input type="radio" id="no" name="status" value="N"><span>下架</span>
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
>
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="describe"]', {
		uploadJson : '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/upload.html',
		allowFileManager : true
	});
	K('#image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#url').val(),
				clickFn : function(url, title, width, height, border, align) {
					K('#url').val(url);
					editor.hideDialog();
				}
			});
		});
	});
});
<?php echo '</script'; ?>
>

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
	    prompt: '输入商品名称'
	});
	$("#btn_save").click(function(){
		var uid = $("#uid").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var cpassword = $("#cpassword").val();
		var nickname = $("#nickname").val();
		var email = $("#email").val();
		var status = $("#hstatus").val();
		
		if(isEmptyVal(username)){
			message('请输入会员帐号','warning');
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
		if(isEmptyVal(nickname)){
			message('请输入昵称','warning');
			return false;
		}
		$.ajax({   
	        type: 'POST', 
	        url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/users-list.html',   
	        data: {
	        	action:'save',
	        	uid:uid,
	        	username:username,
	        	password:password,
	        	cpassword:cpassword,
	        	email:email,
	        	nickname:nickname,
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
		$("#username").val("");
		$("#password").val("");
		$("#cpassword").val("");
		$("#nickname").val("");
		$("#email").val("");
		$('#username').attr('disabled',false);
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
					$("#username").val(data.username);
					$("#password").val("");
					$("#cpassword").val("");
					$("#nickname").val(data.nickname);
					$("#email").val(data.email);
					$("#hstatus").val(data.status);
					$('#username').attr('disabled',true);
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
		var username = row.username;
		$.messager.confirm('删除确认', '是否确认删除帐号'+username+'?', function(r){
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
