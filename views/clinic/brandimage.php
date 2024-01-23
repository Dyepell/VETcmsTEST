<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div class="col-lg-5 clinic-col">
        <?php $form = ActiveForm::begin(['options'=>['id'=>'brandImagesForm'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->field($brandImage, 'id')->textInput(['autocomplete'=>"off", 'readonly'=>'readonly'])?>
        <?= $form->field($brandImage, 'clinicId')->textInput(['autocomplete'=>"off", 'readonly'=>'readonly'])?>
        <?= $form->field($brandImage, 'imageName')->textInput(['autocomplete'=>"off"])?>
        <?= $form->field($brandImage, 'imageDescription')->textInput(['autocomplete'=>"off"])?>
        <?= $form->field($brandImage, 'imageType')->dropDownList(
            ArrayHelper::map(\app\models\BrandImagesTypesForm::find()->orderBy("typeName ASC")->all(), 'id', 'typeName'));?>
        <?= $form->field($brandImage, 'image')->fileInput(['autocomplete'=>"off"])?>
        <div class="row">
            <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>
        </div>
        <?php $form = ActiveForm::end();?>
    </div>
    <div class="col-lg-6 clinic-col">
        <img src="/web/images/Brand images/<?=$brandImage->getAttribute('imagePath')?>" style="padding: 15px;">
    </div>

</div>
