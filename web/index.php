<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../widgets/MercuryWrapper/MercuryWrapper.php';
require __DIR__ . '/../widgets/SbisAPI/SbisAPI.php';
require __DIR__ . '/../widgets/MyUtility/MyUtility.php';

require __DIR__ . '/../widgets/TextFiller/Replacer.php';
require __DIR__ . '/../widgets/TextFiller/TextFiller.php';
require __DIR__ . '/../widgets/TextFiller/DocxReplacer.php';
require __DIR__ . '/../widgets/TextFiller/SimpleTextReplacer.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
