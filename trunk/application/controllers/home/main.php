<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 默认页 2015.4.1
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Main extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->mod = "main";
	}
	//首页
	function index(){
		$data = array('banner'=>1,'headcss'=>'');
		$this->display("index",$data);
	}
	//商品页
	function products($id=0){
		$data = array('banner'=>0,'headcss'=>'products');
		$this->display("products",$data);
	}
	//商品列表
	function products_list($page=1){
		$data = array('banner'=>0,'headcss'=>'productslist');
		$this->display("products_list",$data);
	}
	//联系我们
	function contact(){
		$data = array('banner'=>0,'headcss'=>'contact');
		$this->display("contact",$data);
	}
	//登录
	function login(){
		$bol = $this->user->login("kevin1",'1234qwer');
		var_dump($bol);
	}
	//退出
	function logout(){
		$this->user->logout();
	}
}