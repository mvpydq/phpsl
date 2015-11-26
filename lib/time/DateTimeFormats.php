<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/25
 * Time: 14:10
 */
namespace PHPSL\TIME;

class DateTimeFormats extends BaseTime {
    const DATE_FLAG = "Ymd";
    const DATE_ONLY = "Y-m-d";
    const DATE_TIME_FLAG = "Ymdhi";
    const FULL_DATETIME = "Y-m-d h:i:s";
    const TIME_FLAG = "hi";
    const TIME_ONLY = "h:i:s";

    public static function toDateFlag($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::DATE_FLAG, $timestamp);
    }

    public static function toDateTimeFlag($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::DATE_TIME_FLAG, $timestamp);
    }

    public static function toDateOnly($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::DATE_ONLY, $timestamp);
    }

    public static function toFullDateTime($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::FULL_DATETIME, $timestamp);
    }

    public static function toTimeFlag($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::TIME_FLAG, $timestamp);
    }

    public static function toTimeOnly($time, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date(self::TIME_ONLY, $timestamp);
    }
    
    public static function toSelfDefined($time, $format, $isTimestamp = false) {
        self::initDateZone();
        $timestamp = $isTimestamp ? $time : strtotime($time);
        return date($format, $timestamp);
    }
}
