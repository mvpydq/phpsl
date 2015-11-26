<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/25
 * Time: 16:22
 */
require "../vendor/autoload.php";

use PHPSL\TIME\RoundDateTime;
use PHPSL\CONFIG\CommonConfig;
use PHPSL\NET\CommonNetWork;

date_default_timezone_set("Asia/Shanghai");
$r = new RoundDateTime("2015-11-25 12:33", 10, RoundDateTime::TIME_UNIT_MINUTE, RoundDateTime::MODEL_LATER);
//var_dump($r->next());
//var_dump($r->next());
//var_dump($r->next());
//var_dump($r->next());

//var_dump(CommonConfig::argsConf("a=2&b=3&s"));
//var_dump(CommonConfig::iniFileConf("test.ini"));
//var_dump(php_uname());

var_dump(CommonNetWork::getLocalIP());