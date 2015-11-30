<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/30
 * Time: 17:12
 */

namespace PHPSL\SYS;

use \Exception;

class SafeThread extends Thread {
    private $run;
    private $name;

    public function __construct($runnable, $name = "default") {
        if ($runnable instanceof Runnable) {
            throw new Exception("Object is not runnable");
        } else {
            $this->run = $runnable;
            $this->name = $name;
        }
    }
}