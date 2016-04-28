<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 后台ajax 2015.4.1
 *
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Ajax extends Base_Controller {
	public function __construct() {
		parent::__construct ();
		if ($this->ajax && $this->input->is_ajax_request () == false) {
			show_404 ();
		}
		$this->load->library ( 'admin' );
		$url2 = $this->uri->segment ( 2 );
		if ($url2 != "login" && $this->admin->uid < 1) {
			json_error ( "登录超时，请重新登录!" );
		}
	}
	function login() { // 登录
		$this->admin->login ();
	}
	function pass() { // 修改密码
		$this->admin->pass ();
	}
	function logout() { // 退出
		$this->admin->logout ();
	}
	function users($ajax){//用户相关
		$this->load->library('admin/Musers', 'musers');
		$this->musers->ajax($ajax,$this->admin);
	}
	function setting($ajax) { // 系统设置
		$this->load->library('admin/Msetting','msetting');
		$this->msetting->ajax($ajax,$this->admin );
	}
	function order($ajax) { // 订单管理
		$this->load->library('admin/Msetting','msetting');
		$this->msetting->ajax($ajax,$this->admin );
	}
	function product($ajax){ //商品管理
		$this->load->library('admin/Mproduct','mproduct');
		$this->mproduct->ajax($ajax,$this->admin );
	}
}