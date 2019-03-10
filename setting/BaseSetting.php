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
        if(!defined('LOCATION_GLOBAL_DIR')) {
            define('LOCATION_GLOBAL_DIR', __DIR__ . '/../');
        }
        if (!defined('LOCATION_GLOBAL_MAIN_PATH')) {
            define('LOCATION_GLOBAL_MAIN_PATH', LOCATION_DOMAIN . '/' . $this->_mainDir . '/');
        }
        if(!defined('LOCATION_GLOBAL_MAIN_DIR')) {
            define('LOCATION_GLOBAL_MAIN_DIR', LOCATION_GLOBAL_DIR.'/');
        }

        $this->setFilePathSetting();
    }

    protected function setFilePathSetting()
    {
        if(!defined('LOCATION_GLOBAL_JS_PATH')) {
            define('LOCATION_GLOBAL_JS_PATH', $this->_domain.'/'.$this->_mainDir.'/js/');
        }
        if (!defined('LOCATION_GLOBAL_JS_DIR')) {
            define('LOCATION_GLOBAL_JS_DIR', LOCATION_GLOBAL_DIR . '/js/');
        }
        if (!defined('LOCATION_LOCAL_JS_PATH')) {
            define('LOCATION_LOCAL_JS_PATH', LOCATION_DOMAIN.'/'.$this->_mainDir.'/'.$this->_gameName.'/js/');
        }
        if(!defined('LOCATION_LOCAL_JS_DIR')) {
            define('LOCATION_LOCAL_JS_DIR', LOCATION_GLOBAL_DIR.$this->_gameName.'/js/');
        }
    }

    /*
     * ビューフォルダをセット
     */
    protected function setViewFile($view)
    {
        //$view = preg_replace(' ', '', $view);
        $this->_view = $view;
    }

    /*
     * ビューフォルダを取得
     */
    protected function getViewFile()
    {
        return LOCATION_GLOBAL_MAIN_DIR . $this->_gameName.'/src/View/';
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
        if ($key === 'all') {
            return $this->_exceptionFile;
        } else {
            foreach ($this->_exceptionFile[$key] as $keyFile => $valFile) {
                if ($valFile == $name) {
                    return $valFile;
                }
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


    private function register()
    {
        spl_autoload_register([$this, 'autoLoadClass']);
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
            } else {
                $dir = $this->getFiles($dir, 0);
                if (file_exists($dir . $class . '.php')) {
                    $file = $dir . $class . '.php';
                    if (is_readable($file)) {
                        require_once $file;
                    }
                }
            }
        }
    }

    /*
     * ファイルの取得
     * $dir String
     * @param 0 => 取得
     */
    protected function getFiles($dir, $isGet = 0)
    {
        if (is_dir($dir)) {
            foreach (glob($dir.'*') as $file) {
                if (is_dir($file)) {
                    $this->getFiles($file . '/', $isGet);
                } else {
                    if(file_exists($file)) {
                        if ($isGet === 0) {
                            $file = $this->getSpliceStringFile($file);
                            return $file;
                        }
                    }
                }
            }
        }
    }
    
    public function getEnvironmentDevelop()
    {
        switch($_SERVER['HTTP_HOST']) {
            case 'localhost':
            case '127.0.0.1':
                return true;
                break;
            
            default:
                return false;
                break;
        }
    }

    /*
     * ファイル部分だけ取得する
     * $str ファイルパス
     */
    protected function getSpliceStringFile($filePath)
    {
        $allStr = mb_strlen($filePath, 'utf-8');
        $fileStr = strrpos($filePath, '/', 0);
        $spliceStr = $allStr - $fileStr;
        // [/]分の1文字を引く
        $file = substr($filePath, -($spliceStr - 1));
        return $file;
    }

}
?>
