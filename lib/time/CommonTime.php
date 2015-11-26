<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/25
 * Time: 15:32
 */
namespace PHPSL\TIME;

class CommonTime extends BaseTime {
    const YEAR = "Y";
    const MONTH_DAY = "j";
    const WEEK_DAY = "N";
    const MONTH = "m";
    const HOUR = "H";
    const MINUTE = "i";
    const SECOND = "s";
    const DAYS_OF_MONTH = "t";
    const LEAP_YEAR = "L";
    const TIMEZONE = "T";

    public static function getTimeType($time, $type, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date($type, $timestamp);
    }

    public static function getDaysOfMonth($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::DAYS_OF_MONTH, $timestamp);
    }

    public static function isLeapYear($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::LEAP_YEAR, $timestamp);
    }

    public static function getCurrentTimeZone() {
        self::initDateZone();
        return date(self::TIMEZONE);
    }
}

