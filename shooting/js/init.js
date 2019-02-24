//'use strict';
var initGames = function() {

    function startGames() {
        startAction();
    }

    function startAction() {
        console.log(gamesObj);
    }
    startGames();
}

var gamesObj = {
    currentPoint: 0,
    positionX:0,
    positionY:0,
    startGames: function() {
        initGames();
    }
}

gamesObj.startGames();
//console.log(initGames.gamesObj.currentPoint);