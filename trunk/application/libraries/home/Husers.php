<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * 会员管理 2015.01.29
 *
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Husers {
	private $ci;
	private $users = null;
	function __construct() {
		$this->ci = & get_instance ();
		$this->ci->load->model ('users_model');
		$this->users = $this->ci->users_model;
	}
	function ajax($ajax, $user) {
		switch ($ajax) {
			case 'info' :
				$this->info($user);
				break;
			case 'message' :
				$this->message( $user );
				break;
			default :
				break;
		}
	}
	// --------------------------帐号操作开始---------------------------------
	function info($user){
		$action = get_data("action");
		switch ($action){
			case 'login':
				$email = post('email');
				$password = post('password');
				if($user->uid>0)json_ok();
				if(empty($email))json_error("Email is empty!");
				if(empty($password))json_error("Password is empty!");
				$users = $this->users->get($this->users->table_users,array("email"=>$email));
				if(!isset($users['uid']))json_error("Login fail");
				if($users['password']!=userPass($email,$password))json_error("Login fail");
				$token = $user->setToken();
				$this->users->insert($this->users->table_session,array("token"=>$token,"session"=>json_encode($users),"addtime"=>time()));
				json_ok();
				break;
			case 'registr':
				$email = post('email');
				if($user->uid>0)json_error("Don't repeat registr");
				if(empty($email))json_error("Email is empty!");
				break;
		}
	}
	// --------------------------帐号操作结束---------------------------------
	// --------------------------留言操作开始---------------------------------
	function message($user){
		$action = get_data("action");
		switch ($action){
			case 'save':
				$content = post('content');
				$username = post('username');
				$email = post('email');
				if(empty($content))json_error("Your message is empty");
				
				break;
		}
	}
	// --------------------------留言操作结束---------------------------------
	
}