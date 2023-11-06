<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div class="col-md-4"></div>
    <div class="col-md-4 ">
        <div>
            Пароль
            <input type="password" id="pass" class="form-control" style="width: 100%;margin-bottom: 10px;">
        </div>
        <div class="col" ><a id="button" href="index.php?r=client/addsale" class="btn btn-success" style="width: 100%; margin-bottom: 10px;">Вход</a></div>
    </div>
    <div class="col-md-4"></div>
</div>

<?
$js = <<<JS
    $('#pass').on('input',function() {
      $('#button').attr('href', "index.php?r=client%2Fwriteoff&pass="+$('#pass').val());
    })
JS;

$this->registerJs($js);

?>

