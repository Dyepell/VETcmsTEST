<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>



<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'prihodForm']]) ?>
    <?if(isset($_GET['ID_PRIHOD'])):?>
        <?= $form->field($model, 'ID_PRIHOD')->textInput(['readonly'=>'readonly'])->label('ID поступления')?>
        <?= $form->field($model, 'ID_TOV')->dropDownList(
            ArrayHelper::map(\app\models\Kattov::find()->orderBy("NAME ASC")->all(), 'ID_TOV', 'NAME'), [

            'prompt' => 'Не выбрано...',
            'disabled'=>'true'
        ])->label('Наименование товара');?>
        <?= $form->field($model, 'KOL')->textInput(['autocomplete'=>'off','disabled'=>'true'])->label('Количество')?>
        <?= $form->field($model, 'PRICE')->textInput(['autocomplete'=>'off', 'disabled'=>'true'])->label('Цена закупки')?>
        <?= $form->field($model, 'SELL_PRICE')->textInput(['autocomplete'=>'off', 'disabled'=>'true'])->label('Цена продажи')?>
        <?= $form->field($model, 'EXPIRATION_DATE')->textInput(['autocomplete'=>'off'])->label('Срок годности')?>
        <?= $form->field($model, 'PRIM')->textInput(['autocomplete'=>'off'])->label('Примечание')?>
        <?= $form->field($model, 'DATE')->textInput(['autocomplete'=>'off', 'disabled'=>'true'])->label('Дата')?>
    <? else: ?>
        <?= $form->field($model, 'ID_PRIHOD')->textInput(['readonly'=>'readonly'])->label('ID поступления')?>
        <?= $form->field($model, 'ID_TOV')->dropDownList(
            ArrayHelper::map(\app\models\Kattov::find()->orderBy("NAME ASC")->all(), 'ID_TOV', 'NAME'), [

            'prompt' => 'Не выбрано...',
        ])->label('Наименование товара');?>
        <?= $form->field($model, 'KOL')->textInput(['autocomplete'=>'off'])->label('Количество')?>
        <?= $form->field($model, 'PRICE')->textInput(['autocomplete'=>'off'])->label('Цена закупки')?>
        <?= $form->field($model, 'SELL_PRICE')->textInput(['autocomplete'=>'off'])->label('Цена продажи')?>
        <?= $form->field($model, 'EXPIRATION_DATE')->textInput(['autocomplete'=>'off'])->label('Срок годности')?>
        <?= $form->field($model, 'PRIM')->textInput(['autocomplete'=>'off'])->label('Примечание')?>
        <?= $form->field($model, 'DATE')->textInput(['autocomplete'=>'off'])->label('Дата')?>
    <? endif;?>
    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

        <?php if ($_GET['ID_PRIHOD']!=NULL):?>
            <div class="col-md-10" style="text-align: right">
                <a href="index.php?r=client/prihoddelete&ID_PRIHOD=<?=$model->ID_PRIHOD?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
            </div>
        <?php endif;?>
    </div>

    <?php $form = ActiveForm::end();?>
</div>
