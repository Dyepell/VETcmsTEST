<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="row container-fluid " style="margin-top: 70px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <span style="font-size: 150%">Исследование: <a href="index.php?r=client/anketa&clientId=<?=$pacient->ID_CL?>"><?=$pacient->KLICHKA?></a></span>
        <br>
        <span><a href="index.php?r=client/analysis&ID_PAC=<?=$pacient->ID_PAC?>" class="btn btn-primary">Исследования</a></span>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'priceForm']]) ?>
        <div style="display: flex;">
            <?= $form->field($blood, 'ID_OTHER')->textInput(['readonly'=>'readonly'])->label('ID')?>
            <?= $form->field($blood, 'DATE')->textInput()->label('Дата')?>
            <a href="index.php?r=client/printother&ID_OTHER=<?=$blood->ID_OTHER?>" class="btn btn-success" style="height: 35px;margin-top: 25px;margin-left: 30px;">На печать</a>
        </div>
        <?= $form->field($blood, 'OP')->textarea(['rows'=>25])->label('Описание')?>
        <div class="row">

            <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

            <?php if ($_GET['ID_OTHER']!=NULL):?>
                <div class="col-md-10" style="text-align: right">
                    <a href="index.php?r=client/otherdelete&ID_OTHER=<?=$blood->ID_OTHER?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
                </div>
            <?php endif;?>
        </div>

        <?php $form = ActiveForm::end();?>



    </div>