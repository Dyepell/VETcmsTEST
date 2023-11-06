<?php

use app\models\Doctor;
use app\models\Kattov;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$items=[
    9999=>'По всем расходникам',
    1=>'Терапия',
    2=>'Хирургия',
    3=>'УЗИ',
    4=>'Медикаменты',
    5=>'Вакцинация',
    6=>'Дегельминтация',
    7=>'Анализы',
    8=>'Корм',



];



?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Отчет по расходникам</h1>
    <div class="col">
        <div class="col"></div>
        <div class="col">


            <?= Html::beginForm(['reports/report_vakcine_form', 'id' => 'otchet', 'name'=>'form1'], 'GET'); ?>

            <div class="form-group">

                <?= Html::label('Дата начала', 'FIRST_DATE', ['class' => 'control-label','style'=>'margin-right:100px']) ?>
                <?= Html::label('Дата окончания', 'SECOND_DATE', ['class' => 'control-label']) ?>

                <div style="display: flex;">
                    <?= Html::textInput('FIRST_DATE',$date,['class' => 'form-control','style'=>'width:200px' ]); ?>
                    <?= Html::textInput('SECOND_DATE',$date,['class' => 'form-control','style'=>'width:200px', 'autocomplete'=>'0']); ?>
                    <?= Html::dropDownList('vid', '', $items, ['class'=>'form-control', 'style'=>'width:200px']) ?>


                    <?= Html::submitButton('Сформировать', ['class' => 'btn btn-success', 'id'=>'btn1']) ?>
                </div>


            </div>



            <?php Html::endForm(); ?>
        </div>


    </div>

</div>


