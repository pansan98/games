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
        setPositionX : 50+'%',
        setPositionY : 0,
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
        setPositionX : 50+'%',
        setPositionY : 0,
    },
    keyCodeObj : {
        37: 'ArrowLeft',
        39: 'ArrowRight',
        38: 'ArrowUp',
        40: 'ArrowDown'
    },
    initGames: function() {
        initScreenGames.screenGames();
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
        return initObj.enemyObj;
    },
    getPlayerObj : function() {
        return initObj.playerObj;
    },
    getKeyCode : function(event) {
        event.key = initObj.keyCodeObj[event.keyCode];
        return event;
    }
}

window.onload = function() {
    initObj.initGames();
}
//console.log(initGames.gamesObj.currentPoint);