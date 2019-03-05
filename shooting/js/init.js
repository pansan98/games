'use strict';

// 表示画面用の処理
var initScreenGames = function() {

    var gameScreen = initObj.gameScreen;


    function setStartGames() {
        $(gameScreen).hide();
        $(initObj.endButton).hide();
    }


    setStartGames();
}

// console出力用
function getConsoleLog(log) {
    console.log(log);
}