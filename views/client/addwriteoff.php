<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Kattov;
use yii\widgets\Pjax;

$tovar=Kattov::find()->orderBy(['NAME' => SORT_ASC])->all();

$dropdown=[];
foreach ($tovar as $item){
    $dropdown[$item->ID_TOV]=$item->NAME;


}


?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">




    <?php $form = ActiveForm::begin(['options'=>['id'=>'writeoffForm','method'=>'GET','data-pjax' => true]]) ?>





    <?= $form->field($model, 'ID_PRIHOD')->dropDownList(
        $prihod, [
        'id'=>'dropdown',
        'prompt' => 'Не выбрано...'
    ])->label('Товар');?>
    <?= $form->field($model, 'KOL')->textInput()->label('Количество')?>
    <?= $form->field($model, 'SOTRUDNIK')->dropDownList(
        ArrayHelper::map(\app\models\Doctor::find()->where(['STATUS_R'=>'1'])->all(), 'ID_DOC', 'NAME'), [


        'prompt' => 'Не выбрано...'
    ])->label('Сотрудник');?>
    <?= $form->field($model, 'DATE')->textInput()->label('Дата')?>
    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>
    </div>
    <?php $form = ActiveForm::end();?>

</div>





