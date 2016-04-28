<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 前端ajax 2015.4.1
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
class Ajax extends Base_Controller {
	function __construct(){
		parent::__construct();
	    if($this->ajax && $this->input->is_ajax_request()==false){
	    	show_404();
	    }
	    $this->load->library('user');
	}
	function users($ajax){//用户相关
		$this->load->library('Home/Husers', 'husers');
		$this->husers->ajax($ajax,$this->user);
	}
}