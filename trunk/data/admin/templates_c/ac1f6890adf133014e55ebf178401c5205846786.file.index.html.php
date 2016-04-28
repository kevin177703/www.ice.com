<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-12 12:22:21
         compiled from "E:\www\svn\www.ice.com\trunk\application\views\admin\main\index.html" */ ?>
<?php /*%%SmartyHeaderCode:21142557a5e7df2a0a8-52482151%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac1f6890adf133014e55ebf178401c5205846786' => 
    array (
      0 => 'E:\\www\\svn\\www.ice.com\\trunk\\application\\views\\admin\\main\\index.html',
      1 => 1429165676,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21142557a5e7df2a0a8-52482151',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css' => 0,
    'js' => 0,
    'menu' => 0,
    'admin_app' => 0,
    'images' => 0,
    'username' => 0,
    'web_title' => 0,
    'year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557a5e7e078559_62292236',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a5e7e078559_62292236')) {function content_557a5e7e078559_62292236($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
admin/index.css" rel="stylesheet" type="text/css" /><?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
wikmain.js"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
wikmenu.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">var _menus = <?php echo $_smarty_tpl->tpl_vars['menu']->value;?>
;
 //设置登录窗口
function openPwd() {
     $('#w').window({
         title: '修改密码',
         width: 300,
         modal: true,
         shadow: true,
         closed: true,
         height: 205,
         resizable: false
     });
}
 //初始化左侧
function InitLeftMenu() {
     $(".easyui-accordion1").empty();
     var menulist = "";
     $.each(_menus.menus, function(i, n) {
         menulist += '<div title="' + n.menuname + '"  icon="' + n.icon + '" style="overflow:auto;">';
         menulist += '<ul>';
         $.each(n.menus, function(j, o) {
             menulist += '<li><div><a ref="' + o.menuid + '" href="javascript:;" rel="' + o.url + '" ><span class="icon '              + o.icon + '" >&nbsp;</span><span class="nav">' + o.menuname + '</span></a></div></li> ';
         });
         menulist += '</ul></div>';
     });
     $(".easyui-accordion1").append(menulist);
     $('.easyui-accordion1 li a').click(function() {
         var tabTitle = $(this).children('.nav').text();
         var url = $(this).attr("rel");
         var menuid = $(this).attr("ref");
         var icon = getIcon(menuid, icon);
         addTab(tabTitle, url, icon);
         $('.easyui-accordion1 li div').removeClass("selected");
         $(this).parent().addClass("selected");
     }).hover(function() {
         $(this).parent().addClass("hover");
     }, function() {
         $(this).parent().removeClass("hover");
     });
     $(".easyui-accordion1").accordion();
}
function closePwd() {
     $('#w').window('close');
     $('#password').val('');
     $('#new_password').val('');     $('#c_new_password').val('');
}
$(function() {
     openPwd();
     InitLeftMenu();
     $('#editpass').click(function() {
         $('#w').window({
             title: '修改登录密码'
         });
         $('#w').window('open');
     });     $("#btnSave").click(function() {		 var password = $("#password").val();		 var new_password = $("#new_password").val();		 var c_new_password = $("#c_new_password").val();		 if(isEmptyVal(password)){			message('请输入原密码','warning');			return false;		 }		 if(new_password.length<6){			message('请输入6位或6位以上字符作为密码','warning');			return false;		 }		 if(new_password != c_new_password){			 message('两次新密码不一致','warning');			 return false;		 }		 if(password == new_password){			 message('新密码和原始密码不能一样','warning');			 return false;		 }		 $.ajax({   	        type: 'POST', 	        url: '/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/pass.html',   	        data: {password:password,new_password:new_password,c_new_password:c_new_password},	        dataType:'json',	        beforeSend:function(){   	        	wait_open();	        },		    	        complete: function() {   	        	wait_close();	        } ,	        success: function(data){				if(data.result==true){						message('修改成功','info');					closePwd();				}else {					message(data.msg,'error');			    }               	        }   		});     });
     $('#btnCancel').click(function() { closePwd(); });
     $('#loginOut').click(function() {
         $.messager.confirm('系统提示', '您确定要退出本次登录吗?', function(r) {
             if (r) {
            	 ajax_post("/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/ajax/logout.html",{},"/<?php echo $_smarty_tpl->tpl_vars['admin_app']->value;?>
/index.html");
             }
         });
     });
});
<?php echo '</script'; ?>
>
<body class="easyui-layout" style="overflow-y: hidden" scroll="no">
    <input type="hidden" id="ipt_UserName" name="ipt_UserName" value="kxcces" />
    <noscript>
        <div style="position: absolute; z-index: 100000; height: 2046px; top: 0; left: 0;
            width: 100%; background: white; text-align: center;">
            <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
noscript.gif" alt='抱歉，请开启脚本支持！' />
        </div>
    </noscript>
    <div region="north" split="true" border="false" style="overflow: hidden; height: 30px;
        background: url(<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
layout-browser-hd-bg.gif) #7f99be repeat-x center 50%;
        line-height: 20px; color: #fff; font-family: Verdana, 微软雅黑,黑体">
        <span style="float: right; padding-right: 20px;" class="head">欢迎您：<span style="color: red;"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</span>
	        <a href="javascript:void(0);" style="cursor: pointer; text-decoration: none;" id="editpass">[修改登录密码]</a>
	        <a href="javascript:void(0);" id="loginOut" style="cursor: pointer; text-decoration: none;">[安全退出]</a>        </span>          <span style="padding-left: 10px; font-size: 16px;">
             <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
blocks.gif" style="width: 20px; height: 20px;" align="absmiddle" />后台管理系统         </span>
    </div>
    <div region="south" split="true" style="height: 30px; background: #D2E0F2;">
        <div class="footer">
            &nbsp;&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
 & 后台管理 & 版权所有 & <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</div>
    </div>
    <div region="west" split="true" title="导航菜单" style="width: 180px;" id="west">
        <div class="easyui-accordion1" fit="true" border="false">
            <!--  导航内容 -->
        </div>
    </div>
    <div id="mainPanle" region="center" style="background: #eee; overflow-y: hidden">
        <div id="tabs" class="easyui-tabs" fit="true" border="false">
            <div title="欢迎使用" style="padding: 20px; overflow: hidden;" id="home">
                <span style="font-family: '微软雅黑'; font-size: 28px; color: #1542A4;">欢迎使用<?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
后台管理系统</span>
            </div>
        </div>
    </div>
    <!--修改密码窗口-->
    <div id="w" class="easyui-window" collapsible="false" minimizable="false" maximizable="false"
        icon="icon-save" style="width: 300px; height: 205px; padding: 5px; background: #fafafa;">
        <div class="easyui-layout" fit="true">
            <div region="center" border="false" style="padding: 10px; background: #fff; border: 1px solid #ccc;">
                <table cellpadding="3" style="margin-left:20px;">
                    <tr>
                        <td style="text-align:right;">原始密码：</td>
                        <td><input id="password" type="Password" class="txt01" maxlength="12"/></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">新密码：</td>
                        <td><input id="new_password" type="Password" class="txt01" maxlength="12"/></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">确认密码：</td>
                        <td><input id="c_new_password" type="Password" class="txt01" maxlength="12"/></td>
                    </tr>
                </table>
            </div>
            <div region="south" border="false" style="text-align: right; height: 30px; line-height: 30px;">
                <a id="btnSave" class="easyui-linkbutton" icon="icon-ok" href="javascript:void(0);">确定</a>
                <a id="btnCancel" class="easyui-linkbutton" icon="icon-cancel" href="javascript:void(0);">
                    取消</a>
            </div>
        </div>
    </div>
    <div id="mm" class="easyui-menu" style="width: 150px;">
        <div id="mm-tabclose">关闭</div>
        <div id="mm-tabcloseall">全部关闭</div>
        <div id="mm-tabcloseother">除此之外全部关闭</div>
        <div class="menu-sep"></div>
        <div id="mm-tabcloseright">当前页右侧全部关闭</div>
        <div id="mm-tabcloseleft">当前页左侧全部关闭</div>
        <div class="menu-sep"></div>
        <div id="mm-exit">退出</div>
    </div>
</body>
</html>
<?php }} ?>
