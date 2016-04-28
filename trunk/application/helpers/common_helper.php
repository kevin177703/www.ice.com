<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 加密
 * @param $encrypt 要加密的数据
 * @param $key key
 */
function encrypt($encrypt,$key=null) {
	if(empty($key))$key = KEY;
	$encrypt = is_array($encrypt)?json_encode($encrypt):$encrypt;
	$encrypt = base64_encode($encrypt);
	$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND );
	$passcrypt = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, $key, $encrypt, MCRYPT_MODE_ECB, $iv );
	$encode = base64_encode ( $passcrypt );
	return $encode;
}
/**
 * 解密
 * @param $decrypt 要解密的数据
 * @param string key
 */
function decrypt($decrypt,$key=null) {
	if(empty($key))$key = KEY;
	$decrypt = str_replace(" ","+",$decrypt);
	$decoded = base64_decode ( $decrypt );
	$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND );
	$decrypted = mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_ECB, $iv );
	$decrypted = trim($decrypted);
	$decrypted = base64_decode($decrypted);
	return $decrypted;
}
/**
 * 分割字符串为数组
 * @param  $data 需要分割的字符串
 * @param  $l    分割符
 */
function ex($data,$l=','){
	if(empty($data))return array();
	$data = explode($l, $data);
	return $data;
}
/**
 * 按指定字段排序
 * @param $data 要排序的数组
 * @param $sort 要排序的字段
 * @param $desc 是否倒序
 */
function array2sort($data,$sort,$desc=true){
	$info = array();
	$_key = "array2sort_desc_key";
	foreach ($data as $k=>$v){
		$v[$_key]=$k;
		$info[]=$v;
	}
	$num=count($info);
	if(!$desc){
		for($i=0;$i<$num;$i++){
			for($j=0;$j<$num-1;$j++){
				if($info[$j][$sort] > $info[$j+1][$sort]){
					foreach ($info[$j] as $key=>$temp){
						$t=$info[$j+1][$key];
						$info[$j+1][$key]=$info[$j][$key];
						$info[$j][$key]=$t;
					}
				}
			}
		}
	}
	else{
		for($i=0;$i<$num;$i++){
			for($j=0;$j<$num-1;$j++){
				if($info[$j][$sort] < $info[$j+1][$sort]){
					foreach ($info[$j] as $key=>$temp){
						$t=$info[$j+1][$key];
						$info[$j+1][$key]=$info[$j][$key];
						$info[$j][$key]=$t;
					}
				}
			}
		}
	}
	$data = array();
	foreach ($info as $v){
		$data[$v[$_key]]=$v;
		unset($data[$v[$_key]][$_key]);
	}
	return $data;
}
/**
 * 获取post或get数据
 * @param $name
 */
function get_data($name){
	if(isset($_POST[$name]))return post($name);
	if(isset($_GET[$name]))return get($name);
	return null;
}
/**
 * 合并两个数组
 * @param  $one
 * @param  $two
 */
function merge($one,$two){
	if(empty($one) || count($one)<1)return $two;
	if(empty($two) || count($two)<1)return $one;
	$info = array();
	$i = 0;
	foreach ($one as $v){
		$info[$i]=$v;
		$i++;
	}
	foreach ($two as $v){
		$info[$i]=$v;
		$i++;
	}
	return $info;
}
/**
 * 失败
 * @param $data 参数
 * @param $msg 提示
 */
function json_error($msg="error",$data=array()){
	$data=array("result"=>false,"msg"=>$msg,"data"=>$data);
	echo json_encode($data);
	exit();
}
/**
 * 成功
 * @param $data 参数
 * @param $msg 提示
 */
function json_ok($data=array(),$msg="success"){
	$data=array("result"=>true,"msg"=>$msg,"data"=>$data);
	echo json_encode($data);
	exit();
}
/**
 * 获取post数据
 * @param $name
 */
function post($name){
	$data = ci()->input->post($name,true);
	$data = trim($data);
	return $data;
}
/**
 * 获取get数据
 * @param $name
 */
function get($name){
	$data = ci()->input->get($name,true);
	$data = trim($data);
	return $data;
}
/**
 * 跳转
 * @param $url
 * @param $param
 */
function skip($url="/",$param=null){
	$url = url($url,$param);
	$skip = '页面跳转中...若没跳转，请<a href="'.$url.'">点击这里</a><script>window.location= "'.$url.'";</script>';
	echo $skip;
	exit();
}
/**
 * 生成url
 * @param $url
 * @param $param
 */
function url($url,$param=null){
	if(is_array($param)){
		$str = "";
		foreach ($param as $k=>$v){
			$str .= "&{$k}={$v}";
		}
		$param = ltrim($str,'&');
	}
	$param = empty($param)?"":"?".$param;
	$url = ($url=="/" || empty($url))?"/":$url.".html";
	$url = $url.$param;
	return $url;
}
/**
 * 截取字符串为数组
 * @param $str
 * @param $need
 */
function exString($string,$delimiter){
	$str = explode($delimiter, $string);
	$len = count($str);
	if(empty($str[$len-1]) && $len-1>0){
		unset($str[$len-1]);
	}
	return $str;
}
/**
 * 检查ip
 * @param $ip
 * @param $data
 */
function checkIp($ip,$data){
	$data=exString($data, ',');
	$ipregexp = implode('|', str_replace( array('*','.'), array('\d+','\.') ,$data));
	return preg_match("/^(".$ipregexp.")$/", $ip);
}
/**
 * 获取ci对象
 */
function ci(){
	$CI =& get_instance();
	return $CI;
}
/**
 * 创建随机字符
 * @param  $len 长度
 * @param  $title 首字符
 * @return string
 */
function getRand($len,$title='',$max=false){
	$rand = getRandChr(4).microtime().rand(10000, 90000);
	$rand = getRandChr(32,1).md5($rand).getRandNum(32);
	$rand = str_shuffle($rand);
	$max = strlen($rand)-$len;
	$min = $max-rand(1, $max);
	$rand = $title.substr($rand,$min,$len);
	if($max)$rand=strtoupper($rand);
	return $rand;
}
/**
 * 创建随机数字串
 * @param $len 长度
 * @return string
 */
function getRandNum($len){
	$a = mt_rand(100000000,999999999);
	$b = mt_rand(100000000,999999999);
	$c = mt_rand(100000000,999999999);
	$d = mt_rand(100000000,999999999);
	$e = mt_rand(100000000,999999999);
	$f = mt_rand(1,9);
	$rand = $a.$b.$c.$d.$e;
	$rand = str_shuffle($rand);
	$max = strlen($rand)-$len;
	$min = $max-rand(1, $max);
	$rand = $f.substr($rand,$min,$len-1);
	return $rand;
}
/**
 * 创建随机字符串
 * @param  $len 长度
 * @param  $min 0大小写混合，1全小写，2全大写
 * @return string
 */
function getRandChr($len,$min=0){
	$rand = array_merge(range('a','z'),range('A','Z'));
	shuffle($rand);
	$rand = implode('',array_slice($rand,0,$len));
	if($min==1)$rand=strtolower($rand); //全部小写
	if($min==2)$rand=strtoupper($rand); //全部大写
	return $rand;
}
/**
 * 设置md5
 * @param string $value 需要md5的数据
 * @param string $is_name  是否是name值
 * @param string $key  md5加密密钥
 * @param string $is_ip  是否启用ip加密
 * @return string
 */
function setMd5($value,$is_name=false,$is_ip=true){
	$ip = $is_ip?getIP():"";
	$md5 = md5($value.$ip.CONF_KEY);
	$md5 = $is_name?substr($md5,18,10):substr($md5,3,20);
	return strtoupper($md5);
}
/**
 * 设置cookie
 * @param $name key
 * @param $value value
 * @param $expire 时间，默认浏览器时间
 */
function setCookieI($name,$value,$expire=0){
	$name = APP.'_'.$name;
	setcookie($name,$value,$expire,'/');
	$value = setMd5($value.$name);
	$name = setMd5($name,true);
	setcookie($name,$value,$expire,'/');
}
/**
 * 获取cookie
 * @param $name key
 */
function getCookieI($name){
	$name = APP.'_'.$name;
	$value = isset($_COOKIE[$name])?$_COOKIE[$name]:null;
	if(empty($value))return $value;
	$_name = setMd5($name,true);
	$_value = isset($_COOKIE[$_name])?$_COOKIE[$_name]:null;
	if($_value==setMd5($value.$name)){
		return $value;
	}
	return null;
}
/**
 * 删除cookie
 * @param $name key
 */
function delCookieI($name){
	$name = APP.'_'.$name;
	$_name = setMd5($name,true);
	$time = time()-100;
	setcookie($name,null,$time,'/');
	setcookie($_name,null,$time,'/');
}
/**
 * 删除所有的cookie
 */
function delAllCookie(){
	if(!is_array($_COOKIE) || count($_COOKIE)<1)return false;
	$time = time()-100;
	foreach ($_COOKIE as $k=>$v){
		setcookie($k,null,$time,'/');
	}
}
/**
 * 加密用户密码
 */
function userPass($username,$password){
	$password = strtolower($username).'|'.strtolower($password);
	$password = md5($password);
	$password = strtolower($password);
	return $password;
}
/**
 * 写日志
 */
function writeLog($content,$path=null){
	if(empty($path))$path = APP_LOG.date('Y-m-d').'.php';
	$info = "";
	if(!file_exists($path)){
		$info = "<?php exit('No direct script access allowed');\r\n";
	}
	$info .= "[".date('Y-m-d H:i:s')."]".$content."\r\n";
	write($path, $info);
}
/**
 * 写sql
 */
function writeSql($sql){
	$path = APP_SQL.date('Y-m-d').'.php';
	$info = "";
	if(!file_exists($path)){
		$info = "<?php exit('No direct script access allowed');\r\n";
	}
	$info .= "[".date('Y-m-d H:i:s')."]".$sql."\r\n";
	write($path, $info);
}
/**
 * 写缓存
 */
function writeCache($data,$title){
	$path = APP_CACHE.$title.'.txt';
	$data = json_encode($data);
	write($path, $data,'w+');
}
/**
 * 读取缓存
 */
function readCache($title){
	$path = APP_CACHE.$title.'.txt';
	$data = read($path);
	$data = json_decode($data);
	return $data;
}