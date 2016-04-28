<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 后台用户操作 2015.01.10
 * 
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Admin {
	private $ci;
	private $admin = null;
	private $memcache = null;
	public $user = array ();
	public $uid = 0;
	public $username = "";
	public $status = 0;
	function __construct() {
		$this->ci = & get_instance ();
		$this->ci->load->model('admin_model' );
		$this->admin = $this->ci->admin_model;
		$this->init ();
	}
	// 默认
	function init() {
		$uid = getCookieI ( "uid" );
		if ($uid > 0) {
			$data = $this->admin->get($this->admin->table_admin, array ("uid" => $uid,'hide' => 'N'));
			if (isset ( $data ['uid'] ) && $data ['uid'] > 0) {
				$this->password = $data ['password'];
				unset ( $data ['password'] );
				$this->user = $data;
				foreach ( $data as $k => $v ) {
					$this->$k = $v;
				}
			}
		}
	}
	// 修改密码
	function pass() {
		$password = post ( 'password' );
		$new_password = post ( 'new_password' );
		$c_new_password = post ( 'c_new_password' );
		if (empty ( $password ) || empty ( $new_password ))json_error ( "请填写完整数据" );
		if ($new_password != $c_new_password)json_error ( "两次新密码不一致" );
		if ($new_password == $password)json_error ( "新密码和原始密码不能一样" );
		if (md5 ( $password ) != $this->password)json_error ( "原始密码错误" );
		if ($this->admin->edit ( $this->admin->table_admin,array ("password" => md5 ( $new_password )),array ("uid" => $this->uid))){
			json_ok ();
		} else {
			json_error ( "修改失败" );
		}
	}
	// 退出
	function logout() {
		delCookieI ( 'uid' );
		json_ok ( array (), "退出成功" );
	}
	// 登录
	function login() {
		if ($this->uid > 0)json_ok ( $this->user, "已经登录" );
		$username = post ( "username" );
		$password = post ( 'password' );
		if (empty ( $username ) || empty ( $password ))json_error ( "请输入帐号和密码" );
		$data = $this->admin->get ( $this->admin->table_admin, array ("username" => $username));
		if (isset ( $data ['errorcount'] ) && $data ['errorcount'] >= 5 && $data ['errortime'] + 24 * 3600 > time ()) {
			json_error ( "密码错误超过5次，请24小时后再试" );
		}
		if (isset ( $data ['username'] ) && $data ['password'] == md5 ( $password )) {
			if ($data ['hide'] == "Y")json_error ( "帐号不存在" );
			if ($data ['status'] == "N")json_error ( "您的帐号已经被禁用" );
			setCookieI ( "uid", $data ["uid"] );
			unset ( $data ["password"] );
			$this->admin->edit ( $this->admin->table_admin, array ('errorcount' => 0,'errortime' => 0,'logintime' => time ()), array ("uid" => $data ['uid']) );
			json_ok ( $data, "登录成功" );
		}
		$username = isset ( $data ['username'] ) ? $data ['username'] : "";
		$uid = isset ( $data ['uid'] ) ? $data ['uid'] : '';
		if (isset ($data ['uid'] )) {
			$data ['errorcount'] = ($data ['errortime'] + 24 * 3600 < time ()) ? 0 : $data ['errorcount'];
			$count = isset ( $data ['errorcount'] ) ? $data ['errorcount'] + 1 : 1;
			$this->admin->edit ( $this->admin->table_admin, array ('errorcount' => $count,'errortime' => time () 
				), array ("uid" => $data ['uid']) );
			$ocount = 5 - $count;
			json_error ( "登录失败,此帐号24小时内还有{$ocount}次登录机会" );
		}
		json_error ( "登录失败" );
	}
	// 获取菜单
	function getMenu($admin_app) {
		$data = $this->admin->get_list($this->admin->table_admin_menu,array('status'=>'Y','hide'=>'N'),1000,0,array ('o' => 'sort'));
		$data = $data ['rows'];
		$info = array ();
		$rsort = array ();
		foreach ( $data as $v ) {
			if ($v ['parent_id'] == 0) {
				$info [$v ['id']] ['sort'] = $v ['sort'];
				$info [$v ['id']] ['menuid'] = $v ['id'];
				$info [$v ['id']] ['icon'] = $v ['icon'];
				$info [$v ['id']] ['menuname'] = $v ['name'];
			} else {
				$menus = array (
					'menuid' => $v ['id'],
					'menuname' => $v ['name'],
					'icon' => $v ['icon'],
					'url' => str_replace('admin',$admin_app,$v['url'])
				);
				$info [$v ['parent_id']] ['menus'] [] = $menus;
			}
		}
		foreach ( $info as $k => $v ) {
			if (! isset ( $v ['menus'] ))unset ( $info [$k] );
		}
		$info = array2sort ( $info, 'sort' );
		$data = '{"menus":[';
		foreach ( $info as $v ) {
			$data .= '{';
			$data .= '"menuid":"' . $v ['menuid'] . '",';
			$data .= '"icon":"' . $v ['icon'] . '",';
			$data .= '"menuname":"' . $v ['menuname'] . '",';
			$data .= '"menus":[';
			foreach ( $v ['menus'] as $vv ) {
				$data .= '{"menuid":"'.$vv ['menuid'].'","menuname":"'.$vv ['menuname'].'","icon":"'.$vv ['icon'].'","url":"'.$vv ['url'] . '"},';
			}
			$data .= ']},';
		}
		$data .= ']}';
		return $data;
	}
}