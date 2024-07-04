<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>
<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h3><?=$clinic->clinicName?> <a href="index.php?r=clinic/clinicstats&year=<?=date('Y')?>" class="btn btn-success">Статистика</a></h3>
    <div class="col-lg-6 clinic-col">
        <h4>Основные данные</h4>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'clinicForm']]) ?>

        <?= $form->field($clinic, 'clinicName')->textInput(['autocomplete'=>'off'])?>
        <?= $form->field($clinic, 'entrepreneurName')->textInput(['autocomplete'=>'off'])?>
        <?= $form->field($clinic, 'entrepreneurINN')->textInput(['autocomplete'=>'off'])?>
        <?= $form->field($clinic, 'address')->textInput(['autocomplete'=>'off'])?>
        <?= $form->field($clinic, 'email')->textInput(['autocomplete'=>'off'])?>


        <div class="row">
            <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>
        </div>
        <?php $form = ActiveForm::end();?>
    </div>
    <div class="col-lg-5 clinic-col">
        <h4>Брендовые изображения</h4>
        <?php  if ($brandImages != NULL){
            echo GridView::widget([
                'dataProvider' => $brandImages,
                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {delete}',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl="index.php?r=clinic%2Fbrandimage&id=".$key['id'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },
                            'delete'=>function($model, $key, $index){

                                $myurl="index.php?r=clinic%2Fbrandimagedelete&id=".$key['id'];

                                return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                    'title' => Yii::t('app', 'Удалить'),
                                ]);
                            }
                        ],

                    ],
                    'id',
                    'imageName',
                    'imageType',
                    'imageDescription'
                ]
            ]);
        }
        ?>
        <a href="index.php?r=clinic%2Fbrandimage" class="btn btn-success" style="width: 100%">Добавить изображение</a>
    </div>


</div>

