<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
require_once THIRD_LIB . 'smarty/Smarty.class.php';
class Ismarty extends Smarty {
	function __construct() {
		parent::__construct ();
		$this->left_delimiter = '{{';
		$this->right_delimiter = "}}";
		$this->template_dir = ROOT_APP . 'views';
		$this->compile_dir = DATA_APP . 'templates_c';
		$this->cache_dir = DATA_APP . 'smarty_cache';
		$this->caching = false;
		
		// 创建缓存文件
		$list = array (
				'templates_c',
				'smarty_cache' 
		);
		foreach ( $list as $v ) {
			$path = DATA_APP . $v;
			if (! file_exists ( $path ))
				mkDirList ( $path );
		}
	}
	// assign($key,$value=null)
	// display($html)
}