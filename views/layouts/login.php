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

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php $this->registerCsrfMetaTags() ?>
		<?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => \Yii::getAlias('@commonFolders/Brand Images/').$ico->imagePath]);?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

		<div class="container-fluid my-content">
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
