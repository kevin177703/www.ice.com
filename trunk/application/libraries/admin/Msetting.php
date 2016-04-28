<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 系统设置 2015.4.1
 * 
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Msetting {
	private $ci;
	private $setting = null;
	function __construct() {
		$this->ci = & get_instance ();
		$this->ci->load->model ('setting_model');
		$this->setting = $this->ci->setting_model;
	}
	function ajax($ajax, $admin) {
		switch ($ajax) {
			case 'menu' :
				$this->menu ( $admin );
				break;
		}
	}
	// ------------------------菜单操作开始-----------------------------------
	function menu($admin) {
		$action = get_data ( 'action' );
		switch ($action) {
			case 'save' :
				$id = post ( 'id' );
				$data ['name'] = post ( 'name' );
				$data ['url'] = post ( 'url' );
				$data ['icon'] = post ( 'icon' );
				$data ['sort'] = post ( 'sort' );
				$data ['status'] = post ( 'status' );
				$data ['parent_id'] = post ( 'parent_id' );
				if (empty ( $data ['name'] ))json_error ( "请输入菜单名称" );
				if ($id > 0) {
					if ($this->setting->edit ( $this->setting->table_admin_menu, $data, array ('id' => $id) ) == false) {
						$id = 0;
					}
				} else {
					$id = $this->setting->save ( $this->setting->table_admin_menu, $data );
				}
				if ($id > 0) {
					$data ['id'] = $id;
					json_ok ( $data, "设置成功" );
				}
				json_error ( "设置失败" );
				break;
			case 'all' :
				$page = post ( 'page' );
				$rows = post ( 'rows' );
				if ($page < 1)$page = 1;
				if ($rows < 1)$rows = 20;
				$offset = ($page - 1) * $rows;
				$search = post ( 'search' );
				$where = "";
				if (! empty ( $search ))$where = " where a.name like '%{$search}%' or b.name like '%{$search}%' ";
				$table = $this->setting->table($this->setting->table_admin_menu );
				$sql = "select a.*,b.name as parent from {$table} a LEFT JOIN {$table} b on a.parent_id=b.id " . "{$where} order by id desc ";
				$data = $this->setting->query ( $sql, $rows, $offset );
				$info = array ();
				foreach ( $data ['rows'] as $k => $v ) {
					if ($v ['hide'] == 'Y')continue;
					$info [] = $v;
				}
				$data ['rows'] = $info;
				echo json_encode ( $data );
				break;
			case 'one' :
				$id = post ( 'id' );
				$data = $this->setting->get($this->setting->table_admin_menu, array ('id' => $id,'hide' => 'N'));
				json_ok ( $data );
				break;
			case 'yes' :
				$where ['status'] = 'Y';
				$where ['hide'] = 'N';
				$data = $this->setting->get_list($this->setting->table_admin_menu, $where, $rows, $offset,array('o' => 'sort'));
				echo json_encode ( $data );
				break;
			case 'parent' :
				$parent_id = get_data ( 'parent_id' );
				$where ['parent_id'] = $parent_id;
				$where ['hide'] = 'N';
				$data = $this->setting->get_list ( $this->setting->table_admin_menu, $where, 1000, 0 );
				$data = merge ( array (array ('id' => 0,'name' => '无父类')), $data ['rows'] );
				echo json_encode ( $data );
				break;
			case 'del' :
				$id = post ( 'id' );
				$name = post ( 'name' );
				if ($id < 1)json_error ( "删除失败" );
				if ($this->setting->del ( $this->setting->table_admin_menu, array ('id' => $id)) 
						&& $this->setting->del ( $this->setting->table_admin_menu, array('parent_id' => $id) )){
					json_ok ();
				}
				json_error ( "删除失败" );
				break;
			default :
				break;
		}
	}
	// ------------------------菜单操作结束-----------------------------------
}