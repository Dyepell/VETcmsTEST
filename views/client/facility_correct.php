<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Kattov;
use yii\widgets\Pjax;



?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">


    <?php $form = ActiveForm::begin(['options'=>['id'=>'facilityForm','method'=>'GET']]) ?>

    <?= $form->field($facility, 'ID_PR')->dropDownList(
        ArrayHelper::map(\app\models\Price::find()->all(), 'ID_PR', 'NAME'), [


        'prompt' => 'Не выбрано...',
        'disabled'=>'true'

    ])->label('Услуга');?>
    <?= $form->field($facility, 'ID_DOC')->dropDownList(
        ArrayHelper::map(\app\models\Doctor::find()->where(['STATUS_R'=>'1'])->all(), 'ID_DOC', 'NAME'), [


        'prompt' => 'Не выбрано...'
    ])->label('Сотрудник');?>

    <?= $form->field($facility, 'DATA')->textInput()->label('Дата')?>







    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>


    </div>

    <?php $form = ActiveForm::end();?>

</div>





