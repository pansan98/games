<?php
/*
 * 共通設定
 */

class BaseSetting {
    private $_domain;
    private $_uri;
    private $_mainDir = 'games';

    // bootstrapで使うフォルダの設定
    protected $_autoLoadDir = [];

    // 例外ファイル設定
    protected $_exceptionFile = [];

    public $_view;
    public $_gameName;

    protected function __construct()
    {
        $this->_domain = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'];
        $this->_uri = basename($this->_domain.$_SERVER['SCRIPT_NAME']);
        $this->setDefineLocationSetting($this->_domain, $this->_uri);
        $this->register();
    }

    protected function setDefineLocationSetting($domain = "", $uri = "")
    {
        if (!defined('LOCATION_DOMAIN')) {
            define('LOCATION_DOMAIN', $domain);
        }
        if (!defined('LOCATION_URI')) {
            define('LOCATION_URI', $uri);
        }

        define('LOCATION_DIR', dirname(__FILE__));

        $this->setFilePathSetting();
    }

    protected function setFilePathSetting()
    {
        if(!defined('LOCATION_JS_PATH')) {
            define('LOCATION_JS_PATH', $this->_domain.'/'.$this->_mainDir.'/js/');
        }
    }

    /*
     * ビューフォルダをセット
     */
    protected function setViewFile($view)
    {
        $view = preg_replace(' ', '', $view);
        $this->_view = $view;
    }

    /*
     * ビューフォルダを取得
     */
    protected function getViewFile()
    {
        return LOCATION_DOMAIN.'/'.$this->_mainDir.'/'.$this->_gameName.'/'.$this->_view;
    }

    /*
     * 動作させるゲームフォルダをセット
     */
    protected function setGames($gameName = 'sample')
    {
        $this->_gameName = $gameName;
    }

    /*
     * 動作させるゲームフォルダを取得
     */
    protected function getGames()
    {
        return $this->_gameName;
    }

    /*
     * JSテーマファイルをすべて読み込む（例外ファイルは別途設定）
     * $jsDir String
     */
    public function getJsFile($jsDir)
    {
        if(is_dir($jsDir)) {
            // 除外ファイルが設定されていば処理終了
            $exceptionFile = $this->checkExistsExceptionFile($jsDir);
            if (count($exceptionFile) > 0) {
                // TO DO 例外ファイルがあった時の処理
                return false;
            } else {
                $this->getFiles($jsDir);
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
     * $key String
     * $name String
     * return String
     */
    protected function getExceptionsFiles($key, $name)
    {
        foreach ($this->_exceptionFile[$key] as $keyFile => $valFile) {
            if ($valFile == $name) {
                return $valFile;
            }
        }
    }


    /*
     * キーで格納された配列を取得
     * return array
     * $key String
     */
    protected function checkExistsExceptionFile($key)
    {
        return $this->_exceptionFile[$key];
    }

    /*
     * ファイルをすべて取得
     * $dir String
     * $isGet int
     * param $isGet 0=>出力 1=>取得する
     */
    protected function getFiles($dir, $isGet = 0)
    {
        if (is_dir($dir)) {
            if ($openDir = opendir($dir)) {
                foreach ($openDir as $file) {
                    if (is_dir($file)) {
                        $this->getFiles($dir . $file);
                    } else {
                        if(file_exists(LOCATION_JS_PATH.$file)) {
                            if ($isGet === 0) {
                                echo '<script type="text/javascript" src="' . LOCATION_JS_PATH . $file . '"></script>';
                            } else {
                                return $file;
                            }
                        }
                    }
                }
                closedir($openDir);
            }
        } else {
            // 初期がファイルだったら読み込み
            if (is_file($dir)) {
                if(file_exists(LOCATION_JS_PATH.$dir)) {
                    if ($isGet === 0) {
                        echo '<script type="text/javascript" src="'.LOCATION_JS_PATH.$dir.'"></script>';
                    }
                }
            }
        }
    }

    private function register()
    {
        spl_autoload_register( array($this, 'autoLoadClass'));
    }

    /*
     * 呼び出したclassを読み込む
     */
    private function autoLoadClass($class)
    {
        foreach ($this->_autoLoadDir as $dir) {
            if (file_exists($dir . $class . '.php')) {
                $file = $dir . $class . '.php';
                if (is_readable($file)) {
                    require_once $file;
                }
            }
        }
    }

}
?>
