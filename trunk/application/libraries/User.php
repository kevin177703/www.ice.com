<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 用户操作 2015.01.10
 * 
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class User {
	private $ci;
	private $token_id = 'token_id'; // 令牌id
	private $users = null; // model
	private $session = null;  //session
	public $token = null; // 令牌
	public $user = array (); // 登录信息
	public $uid = 0;
	public $email = "";
	public $status = 0;
	function __construct() {
		$this->ci = & get_instance ();
		$this->ci->load->model('users_model');
		$this->users = $this->ci->users_model;
		$this->init();
	}
	function init() {
		$this->getToken();
		$this->getSession();
		$this->getUser (); // 获取用户信息
	}
	//获取登录令牌
	function getToken() {
		$this->token = getCookieI($this->token_id);
		$this->token = strtolower($this->token);
		return $this->token;
	}
	//初始化用户信息
	function getUser() {
		$this->user=$this->session;
		if ($this->user) {
			unset($this->user->password);
			foreach ( $this->user as $k => $v ) {
				$this->$k = $v;
			}
		}
		return $this->user;
	}
	//获取session
	function getSession(){
		if(!empty($this->token)){
			$session = $this->users->get($this->users->table_session,array("token"=>$this->token,"isadmin"=>"N"));
			if(!empty($session))$this->session = json_decode($session['session']);
		}
	}
	// 设置登录令牌
	function setToken() {
		if(empty($this->token)) {
			$this->token = getRand(20);
			setCookieI($this->token_id, $this->token);
			$this->token =strtolower($this->token);
		}
		return $this->token;
	}
	// 注册
	function register($data) {
		if (!empty ( $this->token ))return "token"; // 已登录
		if (!isset ( $data ['username'] ))return "empty"; // 数据不完整
		$info = $this->users->get_user(array ('username' => $data ['username']));
		if (isset ( $info ['uid'])){
			return "same"; // 有相同的用户
		}
		$data ['password'] = userPass ( $data ['username'], $data ['password'] );
		$uid = $this->users->add_user ( $data );
		if ($uid > 0) {
			// 注册成功后获取一次用户信息
			$info = $this->users->get_user(array ('uid' => $uid));
			$this->_reg ( $info );
			return "success"; // 注册成功
		}
		return "error"; // 注册失败
	}
	// 登录
	function login($username, $password) {
		if (! empty ( $this->token ))return 'token'; // 已登录
		$info = $this->users->get_user ( array ('username' => $username) );
		if (isset ( $info ['password'] ) && $info ['password'] == userPass ( $username, $password )) {
			// 登录成功，记录session
			$this->_reg ( $info );
			return 'success';
		}
		return 'error';
	}
	// 退出
	function logout() {
		if (empty ( $this->token ))return true;
		$this->users->del_session ( $this->token );
		$this->token = null;
		$this->session = null;
		delCookieI ( $this->token_id );
	}
	// 注册成功，注册信息
	private function _reg($info) {
		$this->setToken ();
		unset ( $info ['password'], $info ['transpassword'] );
		$this->setSession (array ("user" => $info) );
		if ($this->ip) {}
		if ($this->pcNo) {
			$same_pc = $this->users->get_same_pc ( $this->pcNo );
		}
	}
}