<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\BrandImagesForm;
use app\models\ClinicForm;


AppAsset::register($this);

$logo = BrandImagesForm::findOne(['imageType' => 1]);
$ico = BrandImagesForm::findOne(['imageType' => 3]);
$clinic = ClinicForm::findOne(['id' => 1]);
$version = \MyUtility\MyUtility::getVersion();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => "/web/images/Brand images/$ico->imagePath"]);?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        //'brandLabel' => Html::img("/web/images/Brand images/$logo->imagePath", ['alt' => $clinic->clinicName, 'style' => 'height: 45px; width: 171px; left: 50px; margin-top:-10px;']),
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'nav-container'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top bg-light my-navbar-test',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Регистрация', 'url' => ['/client/']],

            [
                'label' => 'Справочники',
                'items' => [
                    ['label' => 'Прейскурант', 'url' => ['/client/price']],

                    ['label' => 'Специалисты', 'url' => ['/client/doctor']],
                ],



            ],
            [
                'label' => 'Склад',
                'items' => [
                    ['label' => 'Справочник расходников', 'url' => ['/client/expense_catalog']],

                    ['label' => 'Приход', 'url' => ['/client/expense_prihod']],
                ],



            ],
            [
                'label' => 'Отчеты',
                'items' => [
                    ['label' => 'Отчеты об услугах', 'url' => ['/reports/otchet_uslugi']],

                    ['label' => 'Отчет по специалистам', 'url' => ['/reports/report_spec']],
                    ['label' => 'Отчет по долгам', 'url' => ['/reports/report_dolg']],
                    ['label' => 'Отчет по оплате долгов', 'url' => ['/reports/report_dolg_payment']],
                    ['label' => 'Отчет по новым пациентам', 'url' => ['/reports/report_newpacient']],
                    ['label' => 'Отчет по предстоящим услугам', 'url' => ['/reports/report_predusl']],
                    ['label' => 'Зарплата %', 'url' => ['/reports/report_pay']],
                    ['label' => 'Cредние данные', 'url' => ['/reports/report_stat']],
                    ['label' => 'Отчет по сроку годности', 'url' => ['/reports/report_expiration']],
                    ['label' => 'Отчет по расходникам', 'url' => ['/reports/report_vakcine']],
                    ['label' => 'Отчет по остаткам (магазин)', 'url' => ['/reports/report_ostatki']],
                ],

            ],

            [
                'label' => 'Магазин',
                'items' => [
                    ['label' => 'Справочник товаров', 'url' => ['/client/catalog']],
                    ['label' => 'Поступление товаров', 'url' => ['/client/prihod_tovara']],
                    ['label' => 'Списание товара', 'url' => ['/client/writeoff_pas']],
                    ['label' => 'Продажа товара', 'url' => ['/client/sale']],
                    ['label' => 'Отчет по продажам', 'url' => ['/reports/report_sale']],
                    ['label' => 'Касса', 'url' => ['/cashbox/cashboxpage']],
                ],
            ],
            ['label' => 'Клиника',
                'items' => [
                    ['label' => 'Данные клиники', 'url' => ['/clinic/clinicpage']],
                    ['label' => 'Шаблоны документов', 'url' => ['/docs/templatepage']],
                    ['label' => 'Выйти (' . Yii::$app->request->cookies->getValue('login') . ')', 'url' => ['/auth/logout']]
                ]
            ],
            ['label' => 'Версия: ' . $version['version'] .' от '. $version['date'],
                'url' => ['/client/'],
                'options' => [
                        'class' => 'version'
                ]
            ],

    ]]);
    NavBar::end();
    ?>

    <div class="container-fluid my-content-test">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer row container-fluid;" style="margin-top: 100px;">-->
<!--    <div class="container-fluid" >-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
