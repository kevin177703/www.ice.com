<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-06-12 21:20:37
         compiled from "E:\www\www.ice.com\trunk\application\views\home\header.html" */ ?>
<?php /*%%SmartyHeaderCode:30323557adca5499ad7-88252782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '350224088d2dd790828b58a8e5781764586ad265' => 
    array (
      0 => 'E:\\www\\www.ice.com\\trunk\\application\\views\\home\\header.html',
      1 => 1434109313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30323557adca5499ad7-88252782',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web_title' => 0,
    'third' => 0,
    'css' => 0,
    'js' => 0,
    'headcss' => 0,
    'banner' => 0,
    'images' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_557adca54e3e68_22430940',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557adca54e3e68_22430940')) {function content_557adca54e3e68_22430940($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="copyright" content="ice chemical industry" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
easyui/themes/color.css">
<link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
home/style.css" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
jquery/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
jquery/jquery.SuperSlide.2.1.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['third']->value;?>
jquery/jquery.slides.min.js"><?php echo '</script'; ?>
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
 type="text/javascript">
$( document ).ready(function() {
	$(".productsid, #subtop").hover(
		function () {
			$('.productsid').addClass('act');
			$('#subtop').show();
		},
		function () {
			$('#subtop').hide();
			$('.productsid').removeClass('act');
		}
	);
	$("#topcats li span, .catlist").hover(
		function () {
			var num;
			if($(this).hasClass('catlist')){ 
				num = $(this).index();
			}else{
				num = $(this).parent().index();
			}
			$('#topcats li span').eq(num).addClass('act');
			$('.catlist').eq(num).show();
		},
		function () {
			$('.catlist').hide();
			$('#topcats li span').removeClass('act');
		}
	);
	$('a[href="#login"]').click(function(){
		$('#opacity').fadeIn(300);
		$('#customf').fadeIn(300);
	});
	$('#opacity').click(function(){
		$('#opacity').fadeOut(300);
		$('#customf').fadeOut(300);
	});
	$(".bl li").click(function() {
		if($(this).hasClass('act')){
			$(this).removeClass('act');
			$(this).next().slideUp(300);
		}else{
			$(this).addClass('act');
			$(this).next().slideDown(300);
		}
	});
	$("#login").click(function(){
		$('#opacity').fadeOut(300);
		$('#customf').fadeOut(300);
		var email = $("#login_email").val();
		var password = $("#login_password").val();
		if(isEmptyVal(email)){
			message("email is empty!",'error');
			return false;
		}
		if(isEmptyVal(password)){
			message("password is empty!",'error');
			return false;
		}
		$.ajax({   
	        type: 'POST', 
	        url: '/ajax/users-info.html',   
	        data: {
	        	action:'login',
	        	email:email,
	        	password:password
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
					localhost.href='/';
				}else {
					message(data.msg,'error');
			    }               
	        }   
		});
	});
	
	$("#registr").click(function(){
		var email = $("#reg_email").val();
		if(isEmptyVal(email)){
			message("email is empty!",'error');
			return false;
		}
		$.ajax({   
	        type: 'POST', 
	        url: '/ajax/users-info.html',   
	        data: {
	        	action:'registr',
	        	email:email
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
					localhost.href='/';
				}else {
					message(data.msg,'error');
			    }               
	        }   
		});
	});
});	
	
<?php echo '</script'; ?>
>
</head>
<body class="<?php echo $_smarty_tpl->tpl_vars['headcss']->value;?>
">
	<!--login-->
    <div id="opacity"></div>
    <div id="customf">
        <div class="leff">
            <h3>Customer login</h3>
            <p class="p1">
                <label for="">Login (your email)</label>
                <input type="text" name="login_email" id="login_email" />
            </p>
            <p class="p2">
                <label for="">Password</label>
                <input type="password" name="login_password" id="login_password"/>
            </p>
            <input type="submit" value="Login" id="login"/>
            <div id="logininfo"></div>
        </div>
        <div class="rigg">
            <h3>Customer registration</h3>
            <p class="p1"><span>Registration on our site is simple, quick and absolutely FREE! Just enter your email in field below and we send your password to this email. You can change your password anytime in your profile.</span></p>
            <p class="p2">
                <label for="">Your email</label>
                <input type="email" name="reg_email" id="reg_email"/>
            </p>
            <input type="hidden" name="user_login"/>
            <input type="submit" value="Registration" id="registr"/>
            <div id="reginfo"></div>
        </div>
    </div>
    <!--login end-->
	<div class="header">
    	<div class="top">
        	<div class="warp over">
                <div class="logo"><a href="/">ice chemical industry</a><i></i></div>
                <div class="nav">
                	<ul>
                    	<li class="productsid"><a href="/products-list.html">Products+</a></li>
                        <li><a href="/faq.html">FAQ</a></li>
                        <li><a href="/about.html">About</a></li>
                        <li><a href="/contact.html">Contact us</a></li>
                    </ul>
                </div>
                <div class="login"><a href="#login">Customer login</a><i></i></div>
                <!--subnav-->
                <div id="subtop">
                  <div id="topcats"> <span>categories</span>
                    <ul>
                      <li><span>STIMULATION &amp; EUPHORIA</span></li>
                      <li><span>Smoking</span></li>
                      <li><span>Psychostimulant NEW</span></li>
                      <li><span>Psychostimulant</span></li>
                      <li><span>Hallucinogenic</span></li>
                      <li><span>Dissociative</span></li>
                    </ul>
                  </div>
                  <div id="toplist">
                    <div class="catlist"> <span>products</span>
                      <ul>
                        <li><a href="###">Thirtylone</a></li>
                        <li><a href="###">5FAMB-R</a></li>
                        <li><a href="###">5-MAPB</a></li>
                        <li><a href="###">4FPV9</a></li>
                        <li><a href="###">4FPV8</a></li>
                        <li><a href="###">4-BMC</a></li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                    <div class="catlist"> <span>products</span>
                      <ul>
                        <li><a href="###">THJ-2201</a></li>
                        <li><a href="###">SUBAKB48</a></li>
                        <li><a href="###">STS-135</a></li>
                        <li><a href="###">PX2</a></li>
                        <li><a href="###">MN-018</a></li>
                        <li><a href="###">MDMB-CHMINACA</a></li>
                        <li><a href="###">MAM-2201</a></li>
                        <li><a href="###">FUB-PB-22</a></li>
                        <li><a href="###">EG018 (EG-018)</a></li>
                        <li><a href="###">AB-PINACA</a></li>
                        <li><a href="###">AB-FUBINACA</a></li>
                        <li><a href="###">AB-CHMINACA</a></li>
                        <li><a href="###">5Fur-144</a></li>
                        <li><a href="###">5F-PB-22</a></li>
                        <li><a href="###">5F-AMB</a></li>
                        <li><a href="###">5F-AKB48</a></li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                    <div class="catlist"> <span>products</span>
                      <ul>
                        <li><a href="###">MPHP</a></li>
                        <li><a href="###">Methoxphenidine</a></li>
                        <li><a href="###">Dimethylone (M11)</a></li>
                        <li><a href="###">Alpha-PHP</a></li>
                        <li><a href="###">Allylescaline</a></li>
                        <li><a href="###">5-MeO-MiPT</a></li>
                        <li><a href="###">4F-PVP</a></li>
                        <li><a href="###">Fluorococaine</a></li>
                        <li><a href="###">2-FA</a></li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                    <div class="catlist"> <span>products</span>
                      <ul>
                        <li><a href="###">RTI-111</a></li>
                        <li><a href="###">PV9</a></li>
                        <li><a href="###">PV8 (Crystal)</a></li>
                        <li><a href="###">Methylone (Crystal)</a></li>
                        <li><a href="###">Methoxetamine</a></li>
                        <li><a href="###">MDPV</a></li>
                        <li><a href="###">Ethylphenidate</a></li>
                        <li><a href="###">Ethylone</a></li>
                        <li><a href="###">Dibutylone</a></li>
                        <li><a href="###">Alpha-PVP</a></li>
                        <li><a href="###">4-MEC</a></li>
                        <li><a href="###">4-CMC (crystal)</a></li>
                        <li><a href="###">3-MMC</a></li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                    <div class="catlist"> <span>products</span>
                      <ul>
                        <li><a href="###">5-MeO-DALT</a></li>
                        <li><a href="###">25i-NBOMe</a></li>
                        <li><a href="###">25C-NBOMe</a></li>
                        <li><a href="###">25B-NBOMe</a></li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                    <div class="catlist"> <span>products</span>
                      <ul>
                        <li><a href="###">Methoxetamine</a></li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                  </div>
                </div>
                <!--subnav end-->

            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['banner']->value==1) {?>
		<!--banner-->
        <div id="slides">
          <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
home/banner01.jpg">
          <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
home/banner01.jpg">
          <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
home/banner01.jpg">
        </div>
		<?php echo '<script'; ?>
>
          $(function() {
            $('#slides').slidesjs({
              width: 1920,
              height: 590,
			  play: {
				active: true,
				auto: true,
				interval: 6000
			  }
            });
          });
        <?php echo '</script'; ?>
>
		<!--banner end-->
		<?php }?>
    </div><?php }} ?>
