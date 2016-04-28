<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
/**
 * 会员管理 2015.01.29
 *
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Musers {
	private $ci;
	private $users = null;
	function __construct() {
		$this->ci = & get_instance ();
		$this->ci->load->model ( 'users_model' );
		$this->users = $this->ci->users_model;
	}
	function ajax($ajax, $admin) {
		switch ($ajax) {
			case 'list' :
				$this->ulist ( $admin );
				break;
			case 'group' :
				$this->group ( $admin );
				break;
			case 'message' :
				$this->message( $admin );
				break;
			default :
				break;
		}
	}
	// --------------------------留言操作开始---------------------------------
	function message($admin){
		$action = get_data("action");
		switch ($action){
			case 'all':
				$page = post ( 'page' );
				$rows = post ( 'rows' );
				if ($page < 1)$page = 1;
				if ($rows < 1)$rows = 20;
				$offset = ($page - 1) * $rows;
				$data = $this->users->get_list($this->users->table_users_message, array(), $rows, $offset, array ('o'=>'id'));
				if (count ($data ['rows'] ) > 0) {
					foreach ( $data ['rows'] as $k => $v ) {
						$v ['addtime'] = empty ( $v ['addtime'] ) ? "" : date ( 'Y-m-d H:i:s', $v ['addtime'] );
						$data ['rows'] [$k] = $v;
					}
				}
				echo json_encode ( $data );
				break;
		}
	}
	// --------------------------留言操作结束---------------------------------
	// --------------------------用户操作开始---------------------------------
	function ulist($admin) {
		$action = get_data ( 'action' );
		switch ($action) {
			case 'save' :
				$uid = post('uid');
				$password = post('password');
				$cpassword = post('cpassword');
				$email = post('email');
				$status = post('status');
				if (empty ( $email ))json_error ( "请输入会员email" );
				if (empty ( $password ) && $uid < 1)json_error ( "请输入登录密码" );
				if ($password != $cpassword)json_error ( "两次密码不一致" );
				$data = array (
					'email' => $email,
					'status' => $status 
				);
				if (! empty ( $password ))$data ['password'] = userPass ( $username, $password );
				if ($uid > 0) {
					if ($this->users->edit ( $this->users->table_users, $data, array ('uid' => $uid) ) == false) {
						$uid = 0;
					}
				} else {
					$data ['registertime'] = time ();
					$uid = $this->users->save ($this->users->table_users, $data);
				}
				if ($uid > 0) {
					$data ['uid'] = $uid;
					json_ok ( $data, "设置成功" );
				}
				json_error ( "设置失败" );
				break;
			case 'all' :
				$search = post ( 'search' );
				$page = post ( 'page' );
				$rows = post ( 'rows' );
				if ($page < 1)$page = 1;
				if ($rows < 1)$rows = 20;
				$offset = ($page - 1) * $rows;
				$where = "hide = 'N'";
				if (! empty ( $search ))$where .= " and email like '%{$search}%'";
				$data = $this->users->get_list ( $this->users->table_users, $where, $rows, $offset, array ('o' => 'uid'));
				if (count ( $data ['rows'] ) > 0) {
					foreach ( $data ['rows'] as $k => $v ) {
						$v ['registertime'] = empty ( $v ['registertime'] ) ? "" : date ( 'Y-m-d H:i:s', $v ['registertime'] );
						$v ['logintime'] = empty ( $v ['logintime'] ) ? "" : date ( 'Y-m-d H:i:s', $v ['logintime'] );
						$data ['rows'] [$k] = $v;
					}
				}
				echo json_encode ( $data );
				break;
			case 'one' :
				$uid = post ( 'uid' );
				$data = $this->users->get ( $this->users->table_users, array ('uid' => $uid,'hide' => 'N') );
				if (isset ( $data ['uid'] ))json_ok ( $data );
				json_error ( "获取数据失败" );
				break;
			case 'del' :
				$uid = post ( 'uid' );
				if ($uid < 1)json_error ( "删除失败" );
				if ($this->users->del($this->users->table_users,array('uid'=>$uid))) {
					json_ok ();
				}
				json_error ( "删除失败" );
				break;
			default :
				break;
		}
	}
	// --------------------------用户操作结束---------------------------------
	// --------------------------用户组操作开始-------------------------------
	function group($admin) {
		$action = get_data ( 'action' );
		switch ($action) {
			case 'save' :
				$id = post ( 'id' );
				$name = post ( 'name' );
				$rebate = post ( 'rebate' );
				$mindeposit = post ( 'mindeposit' );
				$maxdeposit = post ( 'maxdeposit' );
				$mindraw = post ( 'mindraw' );
				$maxdraw = post ( 'maxdraw' );
				$banknum = post ( 'banknum' );
				$upmoney = post('upmoney');
				if (empty ( $name ))json_error ( "请输入会员级别" );
				if ($rebate >= 50)json_error ( "请检查返点是否合法" );
				$data = array (
						"name" => $name,
						"rebate" => $rebate,
						"mindraw" => $mindraw,
						"maxdraw" => $maxdraw,
						"banknum"=>$banknum,
						"mindeposit"=>$mindeposit,
						"maxdeposit"=>$maxdeposit,
						"upmoney"=>$upmoney
				);
				if ($id > 0) {
					$admin->is_auth ( 'edit' ); // ajax权限
					if ($this->users->edit ( $this->users->table_users_group, $data, array ('id' => $id) ) == false) {
						$id = 0;
					} else {
						admin_log ( "id->{$id};name->{$name};会员级别", 4 );
					}
				} else {
					$admin->is_auth ( 'add' ); // ajax权限
					$id = $this->users->save ( $this->users->table_users_group, $data );
					if ($id > 0)admin_log ( "id->{$id};name->{$name};会员级别", 2 );
				}
				if ($id > 0) {
					
					$data ['id'] = $id;
					json_ok ( $data, "设置成功" );
				}
				json_error ( "设置失败" );
				break;
			case 'all' :
				$admin->is_auth ( 'sel' ); // ajax权限
				$page = post ( 'page' );
				$rows = post ( 'rows' );
				if ($page < 1)$page = 1;
				if ($rows < 1)$rows = 20;
				$offset = ($page - 1) * $rows;
				$data = $this->users->get_list ( $this->users->table_users_group, array ('hide' => 'N'), $rows, $offset );
				echo json_encode ( $data );
				break;
			case 'one' :
				$id = post ( 'id' );
				$data = $this->users->get ( $this->users->table_users_group, array ('id' => $id,'hide' => 'N' ) );
				if (isset ( $data ['id'] ))json_ok ( $data );
				json_error ( "获取数据失败" );
				break;
			case 'del' :
				$admin->is_auth ( 'del' ); // ajax权限
				$id = post ( 'id' );
				if ($id < 1)json_error ( "删除失败" );
				if ($this->users->del ( $this->users->table_users_group, array ('id' => $id) )) {
					admin_log ( "id->{$id};会员级别", 3 );
					json_ok ();
				}
				json_error ( "删除失败" );
				break;
			case 'list' :
				$data = $this->users->get_list ( $this->users->table_users_group, array ('hide' => 'N'), 1000 );
				if(isset($_GET['bank']) && $_GET['bank']==1){
					$data = merge ( array (array ('id' => 0,'name' => '所有会员')), $data ['rows'] );
				}else{
					$data = merge ( array (array ('id' => 0,'name' => '请选择')), $data ['rows'] );
				}
				echo json_encode ( $data );
				break;
			default :
				break;
		}
	}
	// --------------------------用户组操作结束-------------------------------
}