<section id="main-section">
	<div class="main-body game-screen">
		<div class="enemy-space"></div>
		<div class="player-space">
			<img class="aircraft" src="<?php echo LOCATION_GLOBAL_MAIN_PATH; ?>shooting/image/shooting-img1.jpg" style="width: 10%; position:absolute; transition: ease-in-out .3s;">
		</div>
		<p>ゲーム画面</p>
	</div>
</section>

<button onclick="gamesObj.startGames();" class="start-button">ゲームを開始する</button>
<button onclick="gamesObj.endGames();" class="end-button">ゲームを終了する</button>

<section id="footer-section">
	<div class="game-footer"><p>フッター</p></div>
</section>