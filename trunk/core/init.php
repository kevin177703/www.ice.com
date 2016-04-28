<?php  if ( ! defined('ROOT')) exit('No direct script access allowed');
/**
 * 入口文件 2015.4.1
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
ini_set('date.timezone', 'Asia/Hong_Kong');
header("Content-type: text/html; charset=utf-8");
//后台访问APP
define("ADMIN_APP", "ice");
//可写入目录
define('ROOT_DATA', ROOT.'data/');
//保存时间
define('KEEPTIME', time()+3600*24*365);
$pcNo = md5('pcNokevin&12');
$pcNo = strtoupper($pcNo);
//设置机器码key
define('PCNO', $pcNo);
//设置加密key
define('KEY', '207Pc[1T@#f0$Oe^2&5*e(1!9)');
//必须启用REQUEST_URI
if(!isset($_SERVER['REQUEST_URI'])){
	echo "Please open the REQUEST_URI";
	exit();
}
define('ROOT_URL', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//设置app路径
define('APP_NAME', 'application');
define('ROOT_APP', ROOT.APP_NAME.'/');
//设置模版路径
define('ROOT_VIEWS', ROOT_APP.'views/');
//设置第三方文件路径
define('THIRD_LIB', ROOT_APP.'third_party/');
//设置后缀
define('SUFFIX', '.html');
//设置通用加密key
define('CONF_KEY', 'Ab0o23O6^&@(Bsg0987_~rmq');
//设置admin后台域名保护,若设置独立域名请修改域名保护
define("ADMIN_SAFE_URL", "");
//设置默认app
define('DEFAULT_APP', 'home');
//导入自定义方法
require_once ROOT.'core/common.php';

$url = parse(ROOT_URL);
$app = isset($url['expath'][1])?$url['expath'][1]:'';
$app = strtolower($app);
$path = $url['path'];
if($app=='admin')$app=DEFAULT_APP;
if($app==ADMIN_APP)$app='admin';
if(in_array($app, array('admin',DEFAULT_APP))){
	unset($url['expath'][1]);
	$path = "";
	foreach ($url['expath'] as $v){
		$path .='/'.$v;
	}
	$path = substr($path,1);
	if(empty($path)) {
		$path="/";
	}
}else{
	$app=DEFAULT_APP;
}
define('APP', $app);
define('CHANGE_PATH', APP.'/');
//添加参数
$query = $_SERVER['QUERY_STRING'];
$query = empty($query)?"":"?".$query;
$_SERVER['REQUEST_URI'] = $path.$query;
if(APP=='admin' && ADMIN_SAFE_URL!='' && ADMIN_SAFE_URL!=$_SERVER['HTTP_HOST']){
	echo "无法访问,请联系管理员";
	exit();
}
//设置可写入文件根路径
define('DATA_APP', ROOT_DATA.APP.'/');
//设置日志，缓存，sql语句写入目录
define('APP_LOG', DATA_APP.'log/');
define('APP_CACHE', DATA_APP.'cache/');
define('APP_SQL', DATA_APP.'sql/');
$list = array('log','cache','sql');
foreach ($list as $v){
	$path = DATA_APP.$v;
	if(!file_exists($path))mkDirList($path);
}
if(!file_exists(APP_LOG)){
	echo "File is don't write!";
	writeLog(APP_LOG.'无法写入');
	exit();
}