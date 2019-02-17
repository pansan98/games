<?php
/*
 * 各ゲームの設定を個別に設定
 */

class ChildSetting extends BaseSetting {
    // ゲームフォルダを指定
    protected $_gameFile = 'shooting';

    public function __construct()
    {
        parent::__construct();
        $this->setGameFile($this->_gameFile);
        $this->setViewFile($this->_gameFile);
    }

    private function setGameFile($name)
    {
        parent::setGames($name);
    }

    public function getGames()
    {
        return parent::getGames();
    }

    public function setViewFile($name)
    {
        parent::setViewFile($name);
    }

    public function getViewFile()
    {
        return parent::getViewFile();
    }
}
?>
