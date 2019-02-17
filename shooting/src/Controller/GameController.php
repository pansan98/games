<?php
/*
 * アクション用コントローラー
 */

class GameController {
    protected $_model;

    public $_dirname;
    public $_view;
    public $_controller;

    public function __construct()
    {
        $this->_dirname = dirname(__FILE__);
    }
}
?>
