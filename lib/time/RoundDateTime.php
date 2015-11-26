<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/25
 * Time: 15:09
 */

namespace PHPSL\TIME;

class RoundDateTime extends BaseTime {
    const TIME_UNIT_MINUTE = 1;
    const TIME_UNIT_HOUR = 2;

    const MODEL_EALIER = 1;
    const MODEL_LATER = 2;

    const ROUND_BASE = 5;

    const ROUND_TIME_FORMAT = "Ymd-H:i";

    public $start;
    public $round;
    public $unit;
    public $model;
    private $current;

    public function __construct($start, $round, $unit, $model) {
        $this->start = $start;
        $this->round = $round;
        $this->unit = $unit;
        $this->model = $model;
        $this->initRound();
    }

    private function initRound() {
        self::initDateZone();
        $this->round = ceil(intval($this->round) / self::ROUND_BASE) * self::ROUND_BASE;
        $minute = CommonTime::getTimeType($this->start, CommonTime::MINUTE);
        if (intval($this->model) == self::MODEL_EALIER) {
            $startMinute = floor($minute / $this->round) * $this->round;
        } else {
            $startMinute = ceil($minute / $this->round) * $this->round;
        }

        $this->current = strtotime(DateTimeFormats::toSelfDefined($this->start, "Ymd H:").$startMinute);
    }

    public function next() {
        self::initDateZone();
        $res = DateTimeFormats::toSelfDefined($this->current, self::ROUND_TIME_FORMAT, true);
        if ($this->unit == self::TIME_UNIT_MINUTE) {
            $this->current = $this->current + self::ONE_MINUTE * $this->round;
        } else {
            $this->current = $this->current + self::ONE_HOUR * $this->round;
        }

        return $res;
    }
}