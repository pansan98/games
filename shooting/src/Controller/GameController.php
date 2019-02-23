<?php

require_once __DIR__ . '/../../setting/ChildSetting.php';
/*
 * アクション用コントローラー
 */

class GameController {
    private $_settingObj;
    protected $_model;

    public $_view;
    public $_controller;

    public function __construct()
    {
        $this->_settingObj = new ChildSetting();
        $this->_view = $this->_settingObj->getViewFile();
    }

    public function getFrontView()
    {
        return $this->_view;
    }

    public function outPutExceptionsJsFile($key, $name)
    {
        $this->_settingObj->outPutExceptionsJsFile($key, $name);
    }
}
?>
