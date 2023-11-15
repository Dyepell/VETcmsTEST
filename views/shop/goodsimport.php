<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div class="col-lg-5 clinic-col">
        <h3>Импорт товаров</h3>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'goodsImport'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->field($goodsImport, 'sourceId')->dropDownList(
            ArrayHelper::map(\app\models\GoodsSourceForm::find()->orderBy("name ASC")->all(), 'id', 'name'));?>
        <?= $form->field($goodsImport, 'csvFile')->fileInput(['autocomplete'=>"off"])?>
        <div class="row">
            <div class="col-md-2"><?= Html::submitButton('Импорт',['class'=>'btn btn-success'])?></div>
        </div>
        <?php $form = ActiveForm::end();?>
    </div>

</div>
