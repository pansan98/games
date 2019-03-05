function getGame() {
    let enemyObj = gamesObj.getEnemyObj();
    let playerObj = gamesObj.getPlayerObj();

    function actionGame() {
        // ゲームアクションはここに書く
        function action() {
            function playerAction() {
                //document.onkeydown = getEventOperation();
                window.addEventListener('keydown', getEventOperation);
            }

            function getEventOperation(e) {
                switch(e.key) {
                    case "ArrowLeft":
                        getConsoleLog('←')
                        //setLeftPosition(e);
                        break;
                    case "ArrowRight":
                        getConsoleLog('→')
                        //setRightPosition(e);
                        break;
                    case "ArrowUP":
                        getConsoleLog('↑');
                        //setUpPosition(e);
                        break;
                    case "ArrowDown":
                        getConsoleLog('↓')
                        //setDownPosition(e);
                        break;
                    default:
                        getConsoleLog('キーなし');
                        //getEventOperation(gamesObj.getKeyCode(e));
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
                getConsoleLog('ゲームが始まってるよ');
                getConsoleLog('このログは'+(initObj.gameTimeTimer / 1000)+'秒毎おきに出る');
                timeElapsedLogic();
            }, initObj.gameTimeTimer);
        }

        timeElapsedLogic();
        action();
    }

    actionGame();
}

function endGames() {
    clearTimeout(initObj.gameTimer);
    $(initObj.startButton).show();
    $(initObj.endButton).hide();
    initScreenGames.gameDisplayScreen(false);
    getConsoleLog('ゲームが終了されました。');
}

function startGames() {
    $(initObj.startButton).hide();
    $(initObj.endButton).show();
    initScreenGames.gameDisplayScreen(true);
    initScreenGames.setScreenStyle();
    getGame();
}