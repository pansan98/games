function getGame() {
    if (initObj.gameTimer) {
        initObj.gameTimer = false;
    }

    initObj.gameTimer = setTimeout(function() {
        getConsoleLog('ゲームが始まってるよ');
        getConsoleLog('このログは'+(initObj.gameTimeTimer / 1000)+'秒毎おきに出る');
        getGame();
    }, initObj.gameTimeTimer);
}

function endGames() {
    clearTimeout(initObj.gameTimer);
    $(initObj.startButton).show();
    $(initObj.endButton).hide();
}

function startGames() {
    $(initObj.startButton).hide();
    $(initObj.endButton).show();
    getGame();
}

var changeEnemyObj = {
    positionLeft : initObj.enemyObj.setPositionLeft,
    positionTop : initObj.enemyObj.setPositionTop,
    appearCount : initObj.enemyObj.setAppearCount,
    level : initObj.enemyObj.setLevel,
    timer : initObj.enemyObj.setTimer,
    passHours : initObj.enemyObj.setPassHours
}

var changePlayerObj = {
    currentPoint : initObj.playerObj.setCurrentPoint,
    positionLeft : initObj.playerObj.setPositionLeft,
    positionTop : initObj.playerObj.setPositionTop
}