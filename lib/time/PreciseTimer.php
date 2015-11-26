<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/25
 * Time: 14:46
 */

namespace PHPSL\TIME;

class PreciseTimer {
    protected $checkMsec;
    protected $startMsec;
    protected $name;

    const DEFAULT_NAME = "default_timer";

    public function __construct($name = self::DEFAULT_NAME) {
        $this->name = $name;
    }

    public function start() {
        $this->startMsec = microtime();
    }

    public function reset() {
        $this->checkMsec = 0;
        $this->startMsec = 0;
    }

    public function elaspsedMsec() {
        $this->checkMsec = microtime();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}