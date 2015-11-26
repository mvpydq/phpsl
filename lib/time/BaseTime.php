<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/25
 * Time: 15:36
 */

namespace PHPSL\TIME;

class BaseTime {
    const DEFAULT_TIME_ZONE = "Asia/Shanghai";

    const ONE_MINUTE = 60;
    const ONE_HOUR = 3600;
    const ONE_DAY = 86400;

    public static function initDateZone() {
        date_default_timezone_set(self::DEFAULT_TIME_ZONE);
    }
}