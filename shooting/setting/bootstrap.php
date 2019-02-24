<?php
    require_once __DIR__ . '/ChildSetting.php';
    $childSetting = new ChildSetting();

    if($childSetting->getEnvironmentDevelop()) {
        // 開発環境のini
        ini_set('display_errors', 'On');
    }
    $gameController = new GameController();