<?php
/*
 * 各ゲームの設定を個別に設定
 */

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
        $this->iniSetting();
        //例外ファイルがあれば適用
        //$this->setExceptionsFile('exception', 'sample.js');
    }

    private function iniSetting()
    {
        $this->_autoLoadDir[] = 'model/';
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

    public function outPutExceptionsFile($key, $name)
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
