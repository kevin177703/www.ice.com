<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 后台 2015.4.1
 *
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Main extends Base_Controller {
	public function __construct() {
		parent::__construct ();
		$this->mod = "main";
		$this->load->library ('admin' );
		if ($this->uri->segment ( 1 ) != "login" && $this->admin->uid < 1) {
			skip("/{$this->admin_app}/login" );
		}
	}
	function index() {//主框架
		$menu = $this->admin->getMenu ($this->admin_app);
		$this->assign ( array (
			"year" => date ( 'Y' ),
			'menu' => $menu,
			'username' => $this->admin->username,
		) );
		$this->display('index');
	}
	function login() { // 登录
		$this->display('login');
	}
	function setting($html) { // 系统设置
		$this->display('setting_'.$html );
	}
	function users($type){  //客户管理
		$this->display('users_'.$type);
	}
	function order($type){  //客户管理
		$this->display('order_'.$type);
	}
	function product($type){
		$this->display('product_'.$type);
	}
	function upload(){
		$this->load->library ('iupload');
		$this->iupload->save();
	}
}