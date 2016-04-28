<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 默认Controller 2015.4.1
 * 
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
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
 * @property Ismarty $ismarty
 */
class Base_Controller extends CI_Controller {
	public $user = null;                //user 类
	public $mod = ""; 					// 模版目录
	public $ip = ""; 					// ip地址
	public $admin_app = "";             //后台app
	protected $ajax = true; 			// 启用ajax检查
	public function __construct() {
		parent::__construct ();
		$this->init();
	}
	// 加载项
	private function init() {
		$this->ip = $this->input->ip_address();
		$this->load->library ( array ('ismarty'));
		$this->admin_app = ADMIN_APP;
		if(empty($this->admin_app))$this->admin_app='admin';
		
		$this->load->library("user");
		
		$this->ismarty->assign ('third', '/public/third/');
		$this->ismarty->assign ('css', '/public/css/');
		$this->ismarty->assign ('js', '/public/js/');
		$this->ismarty->assign ('images', '/public/images/');
		$this->ismarty->assign ('admin_app', $this->admin_app);
		$this->ismarty->assign ( 'web_title', 'ICE');
		$this->ismarty->assign ( 'keywords', 'ice');
	}
	
	function display($html, $data = array()) {
		$this->ismarty->assign($data);
		$this->ismarty->display(APP.'/'.$this->mod.'/'.$html.'.html');
	}
	function assign($data) {
		$this->ismarty->assign($data);
	}
	function fetch($html, $data = array()) {
		$this->ismarty->assign($data);
		return $this->ismarty->fetch(APP.'/'.$this->mod.'/'.$html.'.html');
	}
}