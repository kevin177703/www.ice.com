<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
//分解url
function parse($url){
	$info = parse_url($url);
	$path = isset($info['path'])&&!empty($info['path'])?explode('/', $info['path']):"";
	foreach ($path as $v){
		if($v=='index.php')continue;
		$v = str_replace(SUFFIX,'',$v);
		$info['expath'][] = $v;
	}
	return $info;
}
//获取ip
function getIP(){
	if (isset($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"])){
		$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
	}elseif (isset($HTTP_SERVER_VARS["HTTP_CLIENT_IP"])){
		$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"];
	}elseif (isset($HTTP_SERVER_VARS["REMOTE_ADDR"])){
		$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
	}elseif (getenv("HTTP_X_FORWARDED_FOR")){
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	}elseif (getenv("HTTP_CLIENT_IP")){
		$ip = getenv("HTTP_CLIENT_IP");
	}elseif (getenv("REMOTE_ADDR")){
		$ip = getenv("REMOTE_ADDR");
	}elseif(isset($_SERVER['REMOTE_ADDR'])){
		$ip = $_SERVER['REMOTE_ADDR'];
	}else{
		$ip = "";
	}
	preg_match("/[\d\.]{7,15}/", $ip, $cips);
	$ip = isset($cips[0]) ? $cips[0] : 'unknown';
	unset($cips);
	return $ip;
}
/**
 * 创建目录
 * @param $path 写入地址
 * @param $is_file 是否有文件
 */
function mkDirList($path,$is_file=false){
	$path = str_replace('\\','/',$path);
	$info = explode('/', $path);
	$_path = '';
	$len = count($info);
	for($i=0;$i<$len;$i++){
		$_path .= $info[$i];
		if($i==$len-1 && $is_file)continue;
		$_path .= '/';
		if(file_exists($_path))continue;
		@chmod($_path, 0777);
		@mkdir($_path);
		//每层添加index.html,防止目录读取
		if(!file_exists($_path.'index.html')){
			$content = '<!DOCTYPE html><html><head><title>404 Page Not Found</title><meta charset="UTF-8">'
					.'</head><body><h1>404 Page Not Found</h1></body></html>';
			write($_path.'index.html',$content,'w+');
		}
	}
}
/**
 * 写入文件
 * @param  $path
 * @param  $data
 * @param  $mode
 */
function writeFile($path, $data, $mode = FOPEN_WRITE_CREATE_DESTRUCTIVE){
	if ( ! $fp = @fopen($path, $mode)){
		return FALSE;
	}
	flock($fp, LOCK_EX);
	fwrite($fp, $data);
	flock($fp, LOCK_UN);
	fclose($fp);
	return TRUE;
}

/**
 * 文件写入
 * @param $path
 * @param $content
 * @param $mode
 */
function write($path,$content,$mode="a+"){
	mkDirList($path,true);
	writeFile($path,$content,$mode);
}
/**
 * 读取文件
 * @param  $file
 */
function read($file){
	if ( ! file_exists($file)){
		return FALSE;
	}
	if (function_exists('file_get_contents')){
		return file_get_contents($file);
	}
	if ( ! $fp = @fopen($file, FOPEN_READ)){
		return FALSE;
	}
	flock($fp, LOCK_SH);
	$data = '';
	if (filesize($file) > 0){
		$data =& fread($fp, filesize($file));
	}
	flock($fp, LOCK_UN);
	fclose($fp);
	return $data;
}
