<?php
    include_once __DIR__ . '/setting/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="ja">
<?php
    include $gameController->getFrontView('template/head.html.php');
?>
<body>
<?php
    include $gameController->getFrontView('sample.html.php');
?>
</body>
</html>
