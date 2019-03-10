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
        return parent::getGames();
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
        return parent::getExceptionsFiles($key, $name);
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
                        $arrExceptionsJsAllFile = $this->getExceptionsFiles('all');
                        // 例外ファイルが設定されていれば除去
                        if (isset($arrExceptionsJsAllFile)) {
                            foreach ($arrExceptionsJsAllFile as $key => $val) {
                                // 例外ファイルを読み込まない
                                if (strpos($file, $key) === false) {
                                    $file = $this->getSpliceStringFile($file);
                                    echo '<script type="text/javascript" src="'. LOCATION_LOCAL_JS_PATH . $file . '" style="display:block;"></script>';
                                }
                            }
                        } else {
                            $file = $this->getSpliceStringFile($file);
                            echo '<script type="text/javascript" src="'. LOCATION_LOCAL_JS_PATH . $file . '" style="display:block;"></script>';
                        }
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

    /*
     * ファイル部分だけ取得する
     * $str ファイルパス
     */
    public function getSpliceStringFile($filePath)
    {
        return parent::getSpliceStringFile($filePath);
    }
    
    
    public function getChildSetting()
    {
        return $this;
    }
}
?>
