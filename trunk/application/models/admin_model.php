<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台用户相关 2015.4.1
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Admin_model extends Base_Model{
	function __construct(){
		parent::__construct();
	}
	//查询管理
	function get_admin($where){
		$where['hide']='N';
		return $this->get($this->table_admin,$where);
	}
}