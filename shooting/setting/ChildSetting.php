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
        //オートロードの設定
        $this->initAutoLoad(dirname(__FILE__) . '/../src/Model/');
        $this->initAutoLoad(dirname(__FILE__) . '/../src/Controller/');

        $this->setGames($this->_gameFile);
        $this->setViewFile($this->_gameFile);

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
        return $this->getGames();
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
     * ファイルをすべて取得
     * $dir String
     * $isGet int
     * param $isGet 0=>出力 1=>取得
     */
    public function getJsFiles($dir, $isGet = 0)
    {
        if (is_dir($dir)) {
            if ($openDir = opendir($dir)) {
                foreach ($openDir as $file) {
                    if (is_dir($file)) {
                        $this->getJsFiles($dir . $file);
                    } else {
                        if(file_exists($file)) {
                            if ($isGet === 0) {
                                echo '<script type="text/javascript" src="' . $file . '"></script>';
                            } else {
                                return $file;
                            }
                        }
                    }
                }
                closedir($openDir);
            }
        } else {
            // 初期がファイルだったら読み込み
            if (is_file($dir)) {
                if(file_exists($dir)) {
                    if ($isGet === 0) {
                        echo '<script type="text/javascript" src="'.$dir.'"></script>';
                    } else {
                        return $dir;
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
     * JSテーマファイルをすべて読み込む（例外ファイルは別途設定）
     * $jsDir String
     */
//    public function getJsFile($jsDir)
//    {
//        if(is_dir($jsDir)) {
//            // 除外ファイルが設定されていば処理終了
//            $exceptionFile = $this->checkExistsExceptionFile($jsDir);
//            if (count($exceptionFile) > 0) {
//                // TO DO 例外ファイルがあった時の処理
//                return false;
//            } else {
//                $this->getFiles($jsDir);
//            }
//        }
//    }
}
?>
