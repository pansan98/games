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

            getEventOperation = (e) => {
                switch(e.key) {
                    case "ArrowLeft":
                        playerObj.positionX -= 10;
                        playerObj.airCraft[0].style.left = `${playerObj.positionX}px`;
                        break;
                    case "ArrowRight":
                        playerObj.positionX += 10;
                        playerObj.airCraft[0].style.left = `${playerObj.positionX}px`;
                        break;
                    case "ArrowUp":
                        playerObj.positionY -= 10;
                        playerObj.airCraft[0].style.top = `${playerObj.positionY}px`;
                        break;
                    case "ArrowDown":
                        playerObj.positionY += 10;
                        playerObj.airCraft[0].style.top = `${playerObj.positionY}px`;
                        break;
                    default:
                        //キーなし
                        if(gamesObj.getKeyCode(e)) {
                            getEventOperation(gamesObj.getKeyCode(e));
                        }
                        break;
                }
                window.requestAnimationFrame(getEventOperation);

            }

            window.requestAnimationFrame(getEventOperation);
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
    initScreenGames.gameDisplayScreen(initObj.startButton, true);
    initScreenGames.gameDisplayScreen(initObj.endButton, false);
    initScreenGames.gameDisplayScreen(initObj.gameScreen, false);
    getConsole('ゲームが終了されました。');
}

// ゲーム開始時
function startGames() {
    initScreenGames.gameDisplayScreen(initObj.startButton, false);
    initScreenGames.gameDisplayScreen(initObj.endButton, true);
    initScreenGames.gameDisplayScreen(initObj.gameScreen, true);
    initScreenGames.setScreenStyle();
    getGame();
}