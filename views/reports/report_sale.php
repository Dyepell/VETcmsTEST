<?php

use app\models\Doctor;
use app\models\Kattov;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Отчет по продажам</h1>
    <div class="col">
        <div class="col"></div>
        <div class="col">


            <?= Html::beginForm(['reports/report_sale_form', 'id' => 'otchet', 'name'=>'form1'], 'GET'); ?>

            <div class="form-group">

                <?= Html::label('Дата начала', 'FIRST_DATE', ['class' => 'control-label','style'=>'margin-right:100px']) ?>
                <?= Html::label('Дата окончания', 'SECOND_DATE', ['class' => 'control-label']) ?>

                <div style="display: flex;">
                    <?= Html::textInput('FIRST_DATE',$date,['class' => 'form-control','style'=>'width:200px' ]); ?>
                    <?= Html::textInput('SECOND_DATE',$date,['class' => 'form-control','style'=>'width:200px', 'autocomplete'=>'0']); ?>



                    <?= Html::submitButton('Сформировать', ['class' => 'btn btn-success', 'id'=>'btn1']) ?>
                </div>


            </div>



            <?php Html::endForm(); ?>
        </div>


    </div>

</div>


