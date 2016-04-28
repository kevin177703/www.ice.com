<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config ['memcache']=array(
	'host'=>"43.240.51.2",
	'port'=>'11211',
	'expire'=>30*60,        //失效时间,秒
	'prefix'=>'kevin_',
);