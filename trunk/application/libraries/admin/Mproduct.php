<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 商品管理 2015.4.1
 * 
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Mproduct {
	private $ci;
	private $model = null;
	function __construct() {
		$this->ci = & get_instance ();
		$this->ci->load->model ('product_model');
		$this->model = $this->ci->product_model;
	}
	function ajax($ajax, $admin) {
		switch ($ajax) {
			case 'list':
				break;
			case 'type' :
				$this->_type($admin);
				break;
		}
	}
	// ------------------------商品操作开始-----------------------------------
	private function _list($admin){
		
	}
	// ------------------------商品操作结束-----------------------------------
	// ------------------------类型操作开始-----------------------------------
	private function _type($admin) {
		$action = get_data( 'action' );
		switch ($action) {
			case 'save' :
				$id = post ( 'id' );
				$data ['name'] = post ( 'name' );
				$data ['sort'] = post ( 'sort' );
				$data ['status'] = post ( 'status' );
				if (empty ( $data ['name'] ))json_error ( "请输入类型名称" );
				if ($id > 0) {
					if ($this->model->edit ( $this->model->table_product_type, $data, array ('id' => $id) ) == false) {
						$id = 0;
					}
				} else {
					$id = $this->model->save( $this->model->table_product_type, $data );
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
				$search = post ('search' );
				$where = "";
				if (! empty ( $search ))$where = " where name like '%{$search}%'";
				$table = $this->model->table($this->model->table_product_type );
				$sql = "select * from {$table} {$where} order by id desc ";
				$data = $this->model->query ( $sql, $rows, $offset );
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
				$data = $this->model->get($this->model->table_product_type, array ('id' => $id,'hide' => 'N'));
				json_ok ( $data );
				break;
			case 'yes' :
				$where ['status'] = 'Y';
				$where ['hide'] = 'N';
				$data = $this->model->get_list($this->model->table_product_type, $where, $rows, $offset,array('o' => 'sort'));
				echo json_encode ( $data );
				break;
			case 'parent' :
				$parent_id = get_data ( 'parent_id' );
				$where ['parent_id'] = $parent_id;
				$where ['hide'] = 'N';
				$data = $this->model->get_list ( $this->model->table_product_type, $where, 1000, 0 );
				$data = merge ( array (array ('id' => 0,'name' => '无父类')), $data ['rows'] );
				echo json_encode ( $data );
				break;
			case 'del' :
				$id = post ( 'id' );
				$name = post ( 'name' );
				if ($id < 1)json_error ( "删除失败" );
				if ($this->model->del ( $this->model->table_product_type, array ('id' => $id)) 
						&& $this->model->del ( $this->model->table_product_type, array('parent_id' => $id) )){
					json_ok ();
				}
				json_error ( "删除失败" );
				break;
			default :
				break;
		}
	}
	// ------------------------类型操作结束-----------------------------------
}