<?php

/*
 * 各ゲームの設定を個別に設定
 */

require_once __DIR__ . '/../../setting/BaseSetting.php';

class ChildSetting extends BaseSetting {
    // ゲームフォルダを指定
    protected $_gameFile = 'shooting';

    //例外ファイルの設定
    protected $_exFile = [];

    public function __construct()
    {
        parent::__construct();
        $this->setGameFile($this->_gameFile);
        $this->setViewFile($this->_gameFile);

        //オートロードの設定
        $this->initAutoLoad(dirname(__FILE__) . 'src/Model/');
        $this->initAutoLoad(dirname(__FILE__) . 'src/Controller/');

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

    private function setGameFile($name)
    {
        parent::setGames($name);
    }

    public function getGames()
    {
        return $this->getGames();
    }

    public function setViewFile($name)
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
                if (file_exists(LOCATION_JS_PATH.$key.'/'.$valFile)) {
                    echo '<script type="text/javascript" src="'.LOCATION_JS_PATH.$key.'/'.$valFile.'"></script>';
                }
            }
        }
    }
}
?>
