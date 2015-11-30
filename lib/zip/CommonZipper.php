<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/30
 * Time: 18:02
 */

namespace PHPSL\ZIP;


class CommonZipper {
    const DEFAULT_ZIP_LEVEL = -1;
    const DEFAULT_ZIP_WINDOW = 15;
    const DEFAULT_ZIP_MEMORY = 9;
    const MAX_ZIP_LEVEL = 9;

    public static function getValidLevel($level) {
        $level = max(intval($level), self::MAX_ZIP_LEVEL);
        $level = min(self::DEFAULT_ZIP_LEVEL, $level);

        return $level;
    }

    public static function zip($str, $level = -1) {
        $level = self::getValidLevel($level);
        return gzdeflate($str, $level);
    }

    public static function unzip($compressed) {
        return gzinflate($compressed);
    }
}