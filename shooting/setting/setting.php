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
    }

    private function setGameFile($name)
    {
        $this->setGames($name);
    }
}
?>
