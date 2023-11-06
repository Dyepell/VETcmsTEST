<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;use yii\widgets\ActiveForm; ?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'doctorForm']]) ?>

    <?= $form->field($model, 'NAME')->textInput(['autocomplete'=>"off"])->label('ФИО')?>
    <?= $form->field($model, 'STATUS_R')->dropDownList([
    '1' => 'Работает',
    '2' => 'Не работает',

]);?>
    <div class="row container-fluid">

        <div style="display:flex">
            <?= $form->field($model, 'CITY')->textInput(['style'=>'width: 150px;', 'autocomplete'=>'off'])?>
            <?= $form->field($model, 'STREET')->textInput(['style'=>'width: 150px;margin-left: 5px;', 'autocomplete'=>'0'])?>
            <?= $form->field($model, 'HOUSE')->textInput(['style'=>'width: 50px;margin-left: 5px;', 'autocomplete'=>'0'])?>
            <?= $form->field($model, 'FLAT')->textInput(['style'=>'width: 50px;margin-left: 5px;', 'autocomplete'=>'0'])?>
        </div>
        <div style="display:flex">
            <?= $form->field($model, 'PHONE')->textInput(['style'=>'width: 210px;', 'autocomplete'=>'0'])?>
            <?= $form->field($model, 'BDAY')->textInput(['style'=>'width: 210px;', 'autocomplete'=>'0'])?>

        </div>
    </div>
    <h3>Заработная плата</h3>
    <div class="container-fluid row" style="margin-top:30px;margin-bottom:30px;">

        <div class="col-md-2">
            <?= $form->field($model, 'THERAPY')->textInput(['autocomplete'=>"off"])?>
            <?= $form->field($model, 'SURGERY')->textInput(['autocomplete'=>"off"])?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'UZI')->textInput(['autocomplete'=>"off"])?>
            <?= $form->field($model, 'MED')->textInput(['autocomplete'=>"off"])?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'VAKC')->textInput(['autocomplete'=>"off"])?>
            <?= $form->field($model, 'DEG')->textInput(['autocomplete'=>"off"])?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'ANALYZ')->textInput(['autocomplete'=>"off"])?>
            <?= $form->field($model, 'KORM')->textInput(['autocomplete'=>"off"])?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

        <?php if ($_GET['ID_DOC']!=NULL):?>
            <div class="col-md-10" style="text-align: right">
                <a href="index.php?r=client/doctordelete&ID_DOC=<?=$model->ID_DOC?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
            </div>
        <?php endif;?>
    </div>

    <?php $form = ActiveForm::end();?>
</div>
