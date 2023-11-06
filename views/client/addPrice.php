<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;use yii\widgets\ActiveForm; ?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'priceForm']]) ?>
    <?= $form->field($model, 'ID_PR')->textInput(['readonly'=>'readonly'])->label('ID')?>
    <?= $form->field($model, 'DATA')->textInput(['autocomplete'=>"off"])->label('Дата')?>
    <?= $form->field($model, 'ID_SPDOC')->dropDownList(
        ArrayHelper::map(\app\models\Spdoc::find()->all(), 'ID_SPDOC', 'SP_DOC'), [


        'prompt' => 'Не выбрано...'
    ])->label('Вид услуги');?>
    <?= $form->field($model, 'NAME')->textInput(['autocomplete'=>'off'])->label('Наименование')?>
    <?= $form->field($model, 'PRICE')->textInput(['autocomplete'=>'off'])->label('Цена')?>
    <div style="display:flex">
        <?= $form->field($model, 'KOL')->textInput(['autocomplete'=>'off'])->label('Количество')?>
        <?= $form->field($model, 'IZM')->dropDownList(
            ['Шт', 'Мл'], [



        ])->label('Ед. измерения');?>
        <?= $form->field($model, 'IsCount')->checkbox(['style'=>"margin-top:35px; margin-left:10px;", 'id'=>'IsCount', 'onclick'=>"is_count_change()"])?>
    </div>


    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

       <?php if ($_GET['ID_PR']!=NULL):?>
        <div class="col-md-10" style="text-align: right">
            <a href="index.php?r=client/pricedelete&ID_PR=<?=$model->ID_PR?>" class="btn btn-danger" onclick='return confirm("Вы уверены?")' >Удалить</a>
        </div>
        <?php endif;?>
    </div>

<?php $form = ActiveForm::end();?>
</div>
<!--<script>-->
<!--    var isChecked=false;-->
<!--    function is_count_change(){-->
<!--    console.log('test');-->
<!--    $('#priceform-kol').attr('disabled', isChecked);-->
<!--    console.log(isChecked);-->
<!--    isChecked=!isChecked;-->
<!--    }-->
<!--</script>-->
