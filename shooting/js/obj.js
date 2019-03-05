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
        setPositionX : 50,
        setPositionY : 0,
        // 初期の敵数
        setAppearCount: 3,
        // 初期レベル
        setLevel : 1,
        // ゲーム実行時間
        setTimer: 0,
        // レベル変化時間
        setPassHours: 30,
        enemyElements : document.getElementsByClassName('emeny-space')
    },
    playerObj : {
        setCurrentPoint: 3,
        setPositionX : 20,
        setPositionY : 20,
        playerElements : document.getElementsByClassName('player-space'),
        airCraft : document.getElementsByClassName('aircraft')
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
        switch(event.key) {
            case 'ArrowLeft':
            case 'ArrowRight':
            case 'ArrowUp':
            case 'ArrowDown':
                return true;
                break;
            default:
                return false;
                break;
        }
    }
}

window.onload = function() {
    initObj.initGames();
}
//console.log(initGames.gamesObj.currentPoint);