<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use MyUtility\MyUtility;

?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div class = "clinic-col col-lg-5">
        <?php $form = ActiveForm::begin(['options'=>['id'=>'tovarForm']]) ?>
        <?= $form->field($model, 'ID_TOV')->textInput(['readonly'=>'readonly'])->label('ID товара')?>
        <?= $form->field($model, 'NAME')->textInput(['autocomplete'=>"off"])->label('Наименование товара')?>
        <div class="row">
            <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>
        </div>
    </div>

    <div class="col-lg-5 clinic-col">
        <h4>Штрих-коды товара</h4>
        <?php  if ($barcodesModel != NULL){
            echo GridView::widget([
                'dataProvider' => $barcodesModel,
                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{delete}',
                        'buttons'=>[
                            'delete'=>function($model, $key, $index){

                                $myurl="index.php?r=clinic%2Fbrandimagedelete&id=".$key['id'];

                                return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                    'title' => Yii::t('app', 'Удалить'),
                                ]);
                            }
                        ],

                    ],
                    'id',
                    'goodId',
                    'barcode'
                ]
            ]);
        }
        ?>
        <a href="index.php?r=clinic%2Fbrandimage" class="btn btn-success" style="width: 100%">Добавить штрих-код</a>
    </div>

    <?php $form = ActiveForm::end();?>
</div>
