<?php

use app\models\Doctor;
use app\models\Kattov;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Отчет по остаткам (магазин)</h1>
    <div class="col">
        <div class="col"></div>
        <div class="col">


            <?= Html::beginForm(['reports/report_ostatki_form', 'id' => 'otchet', 'name'=>'form1'], 'GET'); ?>

            <div class="form-group">



                <div style="display: flex;">




                    <?= Html::submitButton('Сформировать', ['class' => 'btn btn-success', 'id'=>'btn1']) ?>
                </div>


            </div>



            <?php Html::endForm(); ?>
        </div>


    </div>

</div>


