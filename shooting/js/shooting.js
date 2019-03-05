function getGame() {
    let enemyObj = gamesObj.getEnemyObj();
    let playerObj = gamesObj.getPlayerObj();

    function actionGame() {
        // ゲームアクションはここに書く
        function action() {
            function playerAction() {
                //document.onkeydown = getEventOperation();
                document.addEventListener('keydown', getEventOperation);
            }

            function getEventOperation(e) {
                switch(e.key) {
                    case "ArrowLeft":
                        playerObj.setPositionX = playerObj.setPositionX - 10;
                        initScreenGames.executeProcessMove('left', playerObj.setPositionX);
                        //setLeftPosition(e);
                        break;
                    case "ArrowRight":
                        playerObj.setPositionX = playerObj.setPositionX + 10;
                        initScreenGames.executeProcessMove('left', playerObj.setPositionX);
                        //setRightPosition(e);
                        break;
                    case "ArrowUp":
                        playerObj.setPositionY = playerObj.setPositionY - 10;
                        initScreenGames.executeProcessMove('top', playerObj.setPositionY);
                        //setUpPosition(e);
                        break;
                    case "ArrowDown":
                        playerObj.setPositionY = playerObj.setPositionY + 10;
                        initScreenGames.executeProcessMove('top', playerObj.setPositionY);
                        //setDownPosition(e);//
                        break;
                    default:
                        //キーなし
                        // if(gamesObj.getKeyCode(e)) {
                        //     getEventOperation(gamesObj.getKeyCode(e));
                        //     initObj.keyCodeObj[e.keyCode]
                        // }
                        break;
                }
            }

            playerAction();
        }

        // 一定時間経過ロジック
        function timeElapsedLogic() {
            if (initObj.gameTimer) {
                initObj.gameTimer = false;
            }
        
            initObj.gameTimer = setTimeout(function() {
                getConsole('ゲームが始まってるよ');
                getConsole('このログは'+(initObj.gameTimeTimer / 1000)+'秒毎おきに出る');
                timeElapsedLogic();
            }, initObj.gameTimeTimer);
        }

        timeElapsedLogic();
        action();
    }

    actionGame();
}

// ゲーム終了時
function endGames() {
    clearTimeout(initObj.gameTimer);
    $(initObj.startButton).show();
    $(initObj.endButton).hide();
    initScreenGames.gameDisplayScreen(false);
    getConsole('ゲームが終了されました。');
}

// ゲーム開始時
function startGames() {
    $(initObj.startButton).hide();
    $(initObj.endButton).show();
    initScreenGames.gameDisplayScreen(true);
    initScreenGames.setScreenStyle();
    getGame();
}