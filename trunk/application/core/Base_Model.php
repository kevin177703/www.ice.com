<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 默认Model
 * kevin
 * 2015.4.1
 */
/**
 * 实现代码提示功能
 * 
 * @property CI_Loader $load
 * @property CI_DB_active_record $db
 * @property CI_Calendar $calendar
 * @property Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Language $language
 * @property CI_Log $log
 * @property CI_Input $input
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Unit_test $unit
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $agent
 * @property CI_Validation $validation
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Zip $zip
 * @property CI_Form $form_validation
 */
class Base_Model extends CI_Model {
	public $table_admin = "admin";   						//后台管理
	public $table_admin_menu = "admin_menu";              	//菜单
	
	public $table_product = "product";                      //商品
	public $table_product_type = "product_type";            //商品类型
	
	public $table_users = "users";   						//客户
	public $table_users_message = "users_message";          //客户留言
	
	public $table_session = "session";                      //session
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	// 获取带前缀的表名
	function table($table) {
		return $this->db->protect_identifiers ( $table, TRUE );
	}
	// sql查询
	function query($sql, $limit, $offset = 0) {
		$data = array ('total' => 0,'rows'=>array ());
		$query = $this->db->query ( $sql );
		$data ['total'] = $query->num_rows ();
		if ($data ['total'] < 1) {
			return $data;
		}
		$sql .= " limit {$offset},{$limit}";
		$query = $this->db->query ( $sql );
		$data ['rows'] = $query->result_array ();
		return $data;
	}
	// 获取一条数据的sql查询
	function one($sql) {
		$query = $this->db->query($sql);
		if ($query->num_rows()> 0) {
			return $query->row_array();
		}
		return array();
	}
	// 保存数据
	function save($table, $data) {
		if ($this->db->insert ( $table, $data )) {
			return $this->db->insert_id ();
		}
		return 0;
	}
	//保存数据，不返回id
	function insert($table, $data) {
		return $this->db->insert($table, $data);
	}
	// 修改
	function edit($table, $data, $where) {
		return $this->db->update ( $table, $data, $where );
	}
	// 删除
	function del($table, $where) {
		return $this->db->update($table,array('hide'=>'Y'), $where );
	}
	// 真实删除
	function tdel($table, $where) {
		return $this->db->delete ( $table, $where );
	}
	// 清空
	function del_all($table) {
		return $this->db->empty_table ( $table );
	}
	// 查询单条数据
	function get($table, $where) {
		$query = $this->db->get_where($table, $where );
		if ($query->num_rows () > 0) {
			return $query->row_array ();
		}
		return array ();
	}
	// 列表
	function get_list($table, $where, $limit, $offset = 0, $order = array()) {
		$data = array ('total'=> 0,'rows'=> array ());
		$query = $this->db->get_where ( $table, $where );
		$data ['total'] = $query->num_rows ();
		if ($data ['total'] < 1) {
			return $data;
		}
		if (isset ( $order ['o'] )) {
			$order ['b'] = isset ( $order ['b'] ) ? $order ['b'] : 'desc';
			$this->db->order_by ( $order ['o'], $order ['b'] );
		}
		$query = $this->db->get_where ( $table, $where, $limit, $offset );
		$data ['rows'] = $query->result_array ();
		return $data;
	}
	// 自定义操作
	function db() {
		return $this->db;
	}
	//获取sql语句
	function last_sql(){
		return $this->db->last_query();
	}
}