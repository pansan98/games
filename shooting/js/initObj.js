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
        positionX : 50,
        positionY : 0,
        // 初期の敵数
        appearCount: 3,
        // 初期レベル
        level : 1,
        // ゲーム実行時間
        timer: 0,
        // レベル変化時間
        passHours: 5000,
        enemyElements : document.getElementsByClassName('enemy-space')
    },
    playerObj : {
        // 初期体力
        currentPoint: 3,
        // 初期位置
        positionX : 20,
        positionY : 20,
        keyEvent : false,
        // 移動速度
        moveVelocity: 5,
        playerElements : document.getElementsByClassName('player-space'),
        // 機体
        airCraft : document.getElementsByClassName('aircraft'),
        keyCodeObj : (keyCode) => {
            switch(keyCode) {
                case 37:
                    return 'ArrowLeft';
                    break;
                case 39:
                    return 'ArrowRight';
                    break;
                case 38:
                    return 'ArrowUp';
                    break;
                case 40:
                    return 'ArrowDown';
                    break;
                default:
                    return false;
                    break;
            }
        },
        getKeyCode : (event) => {
            return initObj.playerObj.keyCodeObj(event.keyCode);
        }
    },
    // 画面用処理
    initGames: function() {
        initScreenGames.screenGames();
    }
}

// ゲームオブジェクト
var gamesObj = {
    // ゲームに関する処理設定はここに書く
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
    }
}

window.onload = function() {
    // スタート準備
    initObj.initGames();
}
//console.log(initGames.gamesObj.currentPoint);