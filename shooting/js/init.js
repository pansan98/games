// 表示画面用の処理
var initScreenGames = {
    styleFlg:false,
    screenGames:function() {

        function setStartGames() {
            $(initObj.gameScreen).hide();
            $(initObj.endButton).hide();
        }
    
        setStartGames();
    },
    gameDisplayScreen: function(elem, status) {
        if (status) {
            $(elem).show();
        } else {
            $(elem).hide();
        }
    },
    setScreenStyle: function() {
        // cssが適用されているか
        if (!this.styleFlg) {
            $(initObj.gameScreen).css({
                'width': window.innerWidth,
                'height': window.innerHeight,
                'background': 'black'
            });
            this.styleFlg = true;
        }
        this.executeProcessMove('left', initObj.playerObj.setPositionX);
        this.executeProcessMove('top', initObj.playerObj.setPositionY);
    },
    executeProcessMove: function(position, value) {
        $(initObj.playerObj.airCraft).css(position, value);
    }
}

// console出力用
function getConsole(log) {
    console.log(log);
}