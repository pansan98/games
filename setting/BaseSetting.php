<?php

/*
 * 共通設定
 */

class BaseSetting {
    private $_domain;
    private $_uri;
    private $_mainDir = 'games';

    protected $_exceptionFile = [];

    public $_view;
    public $_gameName;

    public function __construct()
    {
        $this->_domain = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'];
        $this->_uri = basename($this->_domain.$_SERVER['SCRIPT_NAME']);
        $this->setDefineLocationSetting($this->_domain, $this->_uri);
    }

    protected function setDefineLocationSetting($domain = "", $uri = "")
    {
        if (!defined('LOCATION_DOMAIN')) {
            define('LOCATION_DOMAIN', $domain);
        }
        if (!defined('LOCATION_URI')) {
            define('LOCATION_URI', $uri);
        }

        $this->setFilePathSetting();
    }

    protected function setFilePathSetting()
    {
        if(!defined('LOCATION_JS_PATH')) {
            define('LOCATION_JS_PATH', $this->_domain.'/'.$this->_mainDir.'/js/');
        }
    }

    protected function setViewFile($view)
    {
        $view = preg_replace(' ', '', $view);
        $this->_view = $view;
    }

    public function getViewFile()
    {
        return LOCATION_DOMAIN.'/'.$this->_mainDir.'/'.$this->_fileName.'/'.$this->_view;
    }

    public function setGames($gameName = 'sample')
    {
        $this->_gameName = $gameName;
    }

    /*
     * テーマJSファイルをすべて読み込む（例外ファイルは別途設定）
     */
    public function getJsFile($jsDir)
    {
        if(is_dir($jsDir)) {
            // 除外ファイルが設定されていば処理終了
            foreach ($this->getExceptionsFile() as $key => $val) {
                if (strpos($key, $jsDir) !== false) {
                    return false;
                }
            }
            if ($openDir = opendir($jsDir)) {
                foreach ($openDir as $file) {
                    if (is_dir($file)) {
                        $this->getJsFile($file);
                    } else {
                        if(file_exists(LOCATION_JS_PATH.$file)) {
                            echo '<script type="text/javascript" src="'.LOCATION_JS_PATH.$file.'"></script>';
                        }
                    }
                }
            }
        } else {
            // 初期がファイルだったら読み込み
            if(file_exists($jsDir)) {
                echo '<script type="text/javascript" src="'.LOCATION_JS_PATH.$jsDir.'"></script>';
            }
        }
    }


    /*
     * キーをフォルダ名にして例外を格納
     */
    protected function setExceptionsFile($key, $file = array())
    {
        $this->_exceptionFile[$key][] = $file;
    }

    /*
     * 例外ファイルをキーで取得
     * return array
     * $name String
     */
    protected function getExceptionsFile($name = '')
    {
        return $this->_exceptionFile[$name];
    }
}
?>
