<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;use yii\widgets\ActiveForm; ?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'tovarForm']]) ?>
    <?= $form->field($model, 'ID_TOV')->textInput(['readonly'=>'readonly'])->label('ID товара')?>
    <?= $form->field($model, 'NAME')->textInput(['autocomplete'=>"off"])->label('Наименование товара')?>


    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>


    </div>

    <?php $form = ActiveForm::end();?>
</div>
