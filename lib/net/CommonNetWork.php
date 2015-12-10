<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/26
 * Time: 17:55
 */

namespace PHPSL\NET;


class CommonNetWork {
    const IP_DELIMITOR = ".";
    const IPV4_COUNT = 4;

    public static function getLocalIP() {
        $uname = php_uname();
        $ipArr = array();
        if (strpos($uname, "Linux") === 0) {
            exec("ifconfig  | grep 'inet addr:'| grep -v '127.0.0.1' | cut -d: -f2 | awk '{ print $1}'", $ipArr);
            foreach ($ipArr as &$ip) {
                $ip = trim(str_replace("\n", "", $ip));
            }
        } else {
            exec("ipconfig",$out,$stats);
            if(!empty($out))
            {
                foreach($out AS $row)
                {
                    if(strstr($row,"IP") && strstr($row,":") && !strstr($row,"IPv6"))
                    {
                        $preg="/\A((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\Z/";
                        $tmpIp = explode(":", $row);
                        if(preg_match($preg,trim($tmpIp[1])))
                        {
                            $ipArr[] = trim($tmpIp[1]);
                        }
                    }
                }
            }
        }

        return $ipArr;
    }

    public static function isValidIpFromArray($ipArr) {
        $localIp = self::getLocalIP();
        foreach ($ipArr as $ip) {
            if (in_array($ip, $localIp)) {
                return true;
            }
        }

        return false;
    }

    public static function isValidIpFromFile($fname) {
        try {
            if (!file_exists($fname)) {
                return false;
            }
        } catch (\Exception $e) {
            echo $e->getMessage()."\n";
            return false;
        }

        $localIp = self::getLocalIP();

        $fobj = fopen($fname, "r");
        while (!feof($fobj)) {
            $ip = trim(fgets($fobj));
            if (empty($ip)) {
                continue;
            }

            if (in_array($ip, $localIp)) {
                return false;
            }
        }

        return false;
    }

    public static function ipStr2Arr($ipStr) {
        if (!is_string($ipStr) || empty($ipStr)) {
            return array();
        }

        $res = explode(self::IP_DELIMITOR, $ipStr);
        if (count($res) != self::IPV4_COUNT) {
            return array();
        }

        return $res;
    }

    public static function ipStr2Num($ipStr) {
        $ipArr = self::ipStr2Arr($ipStr);
        if (empty($ipArr)) {
            return 0;
        }

        $ipNum = 256 * 256 * 256 * intval($ipArr[0]);
        $ipNum += 256 * 256 * intval($ipArr[1]);
        $ipNum += 256 * intval($ipArr[2]);
        $ipNum += intval($ipArr[3]);

        return $ipNum;
    }

    public static function compareIp($ipStr1, $ipStr2) {
        $ipNum1 = self::ipStr2Num($ipStr1);
        $ipNum2 = self::ipStr2Num($ipStr2);

        if ($ipNum1 > $ipNum2) {
            return 1;
        }
        if ($ipNum1 = $ipNum2) {
            return 0;
        }

        return -1;
    }
}