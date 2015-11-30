<?php
/**
 * Created by PhpStorm.
 * User: yangdaiqing
 * Date: 2015/11/30
 * Time: 18:13
 */

namespace PHPSL\ZIP;


class FileZipper extends CommonZipper {
    public $level;
    public $window;
    public $memory;
    public $fname;

    public function __construct(
        $fname,
        $level = self::DEFAULT_ZIP_LEVEL,
        $window = self::DEFAULT_ZIP_WINDOW,
        $memory = self::DEFAULT_ZIP_MEMORY
    ) {
        $this->fname = $fname;
        $this->level = $level;
        $this->window = $window;
        $this->memory = $memory;
    }

    public function zipToFile($str, $wname = null) {
        $params = array(
            'level' => $this->level,
            'window' => $this->window,
            'memory' => $this->memory
        );

        $wname = $wname === null ? $this->fname : $wname;

        $fp = fopen($wname, 'w');
        stream_filter_append($fp, "zlib.deflate", STREAM_FILTER_WRITE, $params);
        fwrite($fp, $str);
        fclose($fp);

        return 0;
    }

    public function unzipToFile($str, $wname = null) {
        $params = array(
            'window' => $this->window
        );

        $wname = $wname === null ? $this->fname : $wname;

        $fp = fopen($wname, 'w');
        stream_filter_append($fp, "zlib.inflate", STREAM_FILTER_WRITE, $params);
        fwrite($fp, $str);
        fclose($fp);

        return 0;
    }
}