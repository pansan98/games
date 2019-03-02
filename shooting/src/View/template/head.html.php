<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
    <meta charset="utf-8">
    <title><?php echo $childSetting->getGames(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">

    <!-- *** javascript *** -->
    <script src="<?php echo LOCATION_GLOBAL_JS_PATH; ?>jquery-1.7.2.min.js"></script>
    <?php
        $childSetting->getJsFiles(LOCATION_LOCAL_JS_DIR);
    ?>
</head>