<?php

/*
 * 各ゲームの設定を個別に設定
 */

require_once __DIR__ . '/../../setting/BaseSetting.php';

class ChildSetting extends BaseSetting {
    // ゲームフォルダを指定
    protected $_gameDir = 'shooting';

    //例外ファイルの設定
    protected $_exFile = [];

    public function __construct()
    {
        $this->setGames($this->_gameDir);
        $this->setViewFile($this->_gameDir);

        parent::__construct();

        //オートロードの設定
        $this->initAutoLoad(dirname(__FILE__) . '/../src/Model/');
        $this->initAutoLoad(dirname(__FILE__) . '/../src/Controller/');

        //例外ファイルがあれば適用
        $this->setExceptionsFile('exception', 'sample.js');
    }

    /*
     * オートロード適用フォルダを指定
     */
    private function initAutoLoad($dir)
    {
        $this->_autoLoadDir[] = $dir;
    }

    protected function createExceptionFiles($file)
    {
        $this->_exFile[] = $file;
    }

    protected function setGames($name = 'sample')
    {
        parent::setGames($name);
    }

    public function getGames()
    {
        parent::getGames();
    }

    protected function setViewFile($name)
    {
        parent::setViewFile($name);
    }

    public function getViewFile()
    {
        return parent::getViewFile();
    }

    public function setExceptionFile($key, $file)
    {
        $this->createExceptionFiles($file);
        parent::setExceptionsFile($key, $this->_exFile);
    }

    public function getExceptionsFiles($key = 'sample', $name = 'sample.js') {
        parent::getExceptionsFiles($key, $name);
    }

    /*
     * 例外ファイルの出力
     */
    public function outPutExceptionsJsFile($key, $name)
    {
        foreach ($this->_exceptionFile[$key] as $keyFile => $valFile) {
            if ($valFile == $name) {
                if (file_exists(LOCATION_LOCAL_JS_PATH.$key.'/'.$valFile)) {
                    echo '<script type="text/javascript" src="'.LOCATION_LOCAL_JS_PATH.$key.'/'.$valFile.'"></script>';
                }
            }
        }
    }

    /*
     * JSファイルをすべて取得
     * $dir String
     */
    public function getJsFiles($dir)
    {
        clearstatcache();
        if (is_dir($dir)) {
            foreach (glob($dir.'*') as $file) {
                if (is_dir($file)) {
                    $this->getJsFiles($file . '/');
                } else {
                    if(file_exists($file)) {
                        $file = $this->getSpliceStringFile($file);
                        echo '<script type="text/javascript" src="'. LOCATION_LOCAL_JS_PATH . $file . '" style="display:block;"></script>';
                    }
                }
            }
        } else {
            // 初期がファイルだったら読み込み
            if (is_file($dir)) {
                if(file_exists($dir)) {
                    echo '<script type="text/javascript" src="'.$dir.'"></script>';
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
    public function getSpliceStringFile($filePath)
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
