function getGame() {
    let enemyObj = new gamesObj.getEnemyObj();
    let playerObj = new gamesObj.getPlayerObj();

    function actionGame() {
        // ゲームアクションはここに書く
        function action() {

            // playerロジック
            function playerAction() {
                // キー押下時
                document.addEventListener('keydown', event => {
                    playerObj.keyEvent = playerObj.getKeyCode(event);
                });

                // キー外した時
                document.addEventListener('keyup', () => {
                    playerObj.keyEvent = false;
                });
            }

            // イベントリスナー
            getEventOperation = () => {
                switch(playerObj.keyEvent) {
                    case "ArrowLeft":
                        playerObj.positionX -= playerObj.moveVelocity;
                        playerObj.airCraft[0].style.left = `${playerObj.positionX}px`;
                        break;
                    case "ArrowRight":
                        playerObj.positionX += playerObj.moveVelocity;
                        playerObj.airCraft[0].style.left = `${playerObj.positionX}px`;
                        break;
                    case "ArrowUp":
                        playerObj.positionY -= playerObj.moveVelocity;
                        playerObj.airCraft[0].style.top = `${playerObj.positionY}px`;
                        break;
                    case "ArrowDown":
                        playerObj.positionY += playerObj.moveVelocity;
                        playerObj.airCraft[0].style.top = `${playerObj.positionY}px`;
                        break;
                    default:
                        //キーなし
                        // if(gamesObj.getKeyCode(playerObj.keyEvent)) {
                        //     getEventOperation(gamesObj.getKeyCode(e));
                        // }
                        break;
                }
                // キューの追加
                window.requestAnimationFrame(getEventOperation);

            }

            // キューの追加
            window.requestAnimationFrame(getEventOperation);
            playerAction();
        }

        // enemyロジック
        changeLevel = () => {
            enemyObj.level += 1;

            // レベルに応じて時間を増やす
            changeTime = (isLevel) => {

                getTimer(isLevel);

                function getTimer(level) {
                    if(4 <= level > 7) {
                        initObj.gameTimeTimer += initObj.gameTimeTimer;
                    } else if (7 <= level > 10) {
                        initObj.gameTimeTimer += initObj.gameTimeTimer;
                    } else if(10 <= level) {
                        initObj.gameTimeTimer += (initObj.gameTimeTimer * 2);
                    }
                }
            }

            changeTime(enemyObj.level);
        }
        // 一定時間経過ロジック
        function timeElapsedLogic() {
            if (initObj.gameTimer) {
                initObj.gameTimer = false;
            }
        
            initObj.gameTimer = setTimeout(function() {
                getConsole('このログは'+(initObj.gameTimeTimer / 1000)+'秒毎おきに出る');
                getConsole('現在のレベルは'+enemyObj.level+'です');
                // 一定ロジック
                changeLevel();
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