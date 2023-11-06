<?php

use app\models\Doctor;
use app\models\Kattov;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$items=[
    0=>'По пациентам',
    1=>'По специалистам',
    2=>'По пациентам сокращенный',

];

?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Отчеты об услугах</h1>
    <div class="col">
        <div class="col"></div>
        <div class="col">


            <?= Html::beginForm(['reports/otchet_uslugi_form', 'id' => 'spec', 'name'=>'form1'], 'GET'); ?>

            <div class="form-group">

                <?= Html::label('Дата начала', 'FIRST_DATE_S', ['class' => 'control-label','style'=>'margin-right:100px']) ?>
                <?= Html::label('Дата окончания', 'SECOND_DATE_S', ['class' => 'control-label']) ?>
                <?= Html::label('Вид отчета', 'vid', ['class' => 'control-label', 'style'=>'margin-left:90px;']) ?>

                <div style="display: flex;">
                <?= Html::textInput('FIRST_DATE_S','',['class' => 'form-control','style'=>'width:200px' ]); ?>
                <?= Html::textInput('SECOND_DATE_S',$date,['class' => 'form-control','style'=>'width:200px', 'autocomplete'=>'0']); ?>

                <?= Html::dropDownList('vid', '', $items, ['class'=>'form-control', 'style'=>'width:200px']) ?>



                <?= Html::submitButton('Сформировать', ['class' => 'btn btn-success', 'id'=>'btn1']) ?>
                </div>


            </div>



            <?php Html::endForm(); ?>
        </div>


    </div>

</div>


