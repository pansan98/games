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
    gameDisplayScreen: function(status) {
        if (status) {
            $(initObj.gameScreen).show();
        } else {
            $(initObj.gameScreen).hide();
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
    }
}

// console出力用
function getConsoleLog(log) {
    console.log(log);
}