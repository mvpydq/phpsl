<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/26
 * Time: 17:33
 */
namespace PHPSL\CONFIG;

class CommonConfig {
    const ARGS_OUTER_DELIMITOR = "&";
    const ARGS_INNER_DELIMITOR = "=";
    const PAIR_COUNT = 2;
    const INDEX_KEY = 0;
    const INDEX_VALUE = 1;

    public static function argsConf($args) {
        if (!is_string($args)) {
            return array();
        }

        $conf = array();
        $tmp = explode(self::ARGS_OUTER_DELIMITOR, $args);
        foreach ($tmp as $item) {
            $pair = explode(self::ARGS_INNER_DELIMITOR, $item);
            if (count($pair) != self::PAIR_COUNT) {
                continue;
            }

            $conf[$pair[self::INDEX_KEY]] = $pair[self::INDEX_VALUE];
        }

        return $conf;
    }

    public static function iniFileConf($fname) {
        if (empty($fname) || !is_string($fname) || !file_exists($fname)) {
            return array();
        }

        $fobj = fopen($fname, "r");
        $conf = array();
        $current = &$conf;
        while (!feof($fobj)) {
            $line = trim(fgets($fobj));
            if (empty($line)) {
                continue;
            }

            $len = strlen($line);
            if ($line[0] == "[" && $line[$len - 1] == "]") {
                $group = substr($line, 1, $len - 2);
                $conf[$group] = array();
                $current = &$conf[$group];
            } else {
                $tmp = explode(self::ARGS_INNER_DELIMITOR, $line);
                if (count($tmp) != self::PAIR_COUNT) {
                    continue;
                }

                $current[$tmp[self::INDEX_KEY]] = $tmp[self::INDEX_VALUE];
            }
        }

        return $conf;
    }
}