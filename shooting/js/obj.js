// 設定オブジェクト
var initObj = {
    // 初期設定はここで行う
    gameScreen: document.getElementsByClassName('game-screen'),
    startButton: document.getElementsByClassName('start-button'),
    endButton: document.getElementsByClassName('end-button'),
    gameTimer: false,
    gameTimeTimer: 5000,
    enemyObj : {
        // 初期位置
        setPositionLeft : 50+'%',
        setPositionTop : 0,
        // 初期の敵数
        setAppearCount: 3,
        // 初期レベル
        setLevel : 1,
        // ゲーム実行時間
        setTimer: 0,
        // レベル変化時間
        setPassHours: 30,
    },
    playerObj : {
        setCurrentPoint: 3,
        setPositionLeft : 50+'%',
        setPositionTop : -1,
    },
    initGames: function() {
        initScreenGames();
    }
}

// ゲームオブジェクト
var gamesObj = {
    startGames: function() {
        startGames();
    },
    endGames: function() {
        endGames();
    },
    getEnemyObj : function () {
        return changeEnemyObj;
    },
    getPlayerObj : function() {
        return changePlayerObj;
    }
}

window.onload = function() {
    initObj.initGames();
}
//console.log(initGames.gamesObj.currentPoint);