<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;




?>


    <div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
        <?=$dif?>
        <h1>Поступление товара</h1>
        <div class="col">
            <div class="col"><a href="index.php?r=client/prihod" class="btn btn-success" style="width: 100%; margin-bottom: 10px;">Добавить товар</a></div>
            <div class="col"><a href="index.php?r=shop%2Fgoodsimport" class="btn btn-success" style="width: 100%; margin-bottom: 10px;">Импорт товаров</a></div>
            <?= Html::beginForm(['client/report_prihod', 'id' => 'otchet', 'name'=>'form1'], 'GET'); ?>

            <div class="form-group">

                <?= Html::label('Дата начала', 'FIRST_DATE', ['class' => 'control-label','style'=>'margin-right:100px']) ?>
                <?= Html::label('Дата окончания', 'SECOND_DATE', ['class' => 'control-label']) ?>

                <div style="display: flex;">
                    <?= Html::textInput('FIRST_DATE','',['class' => 'form-control','style'=>'width:200px' ]); ?>
                    <?= Html::textInput('SECOND_DATE',$date,['class' => 'form-control','style'=>'width:200px', 'autocomplete'=>'0']); ?>



                    <?= Html::submitButton('Сформировать отчет по поставкам', ['class' => 'btn btn-primary', 'id'=>'btn1']) ?>
                </div>


            </div>



            <?php Html::endForm(); ?>
            <div class="col">

                <div >
                    <?php

                    echo GridView::widget([
                        'dataProvider'=>$PrihodProvider,
                        'pager'=>[
                            'lastPageLabel'=>'>|',
                            'firstPageLabel'=>'|<',
                            'maxButtonCount'=>7,

                        ],

                        'columns'=>[
                            ['class' => 'yii\grid\ActionColumn',
                                'template'=>'{delete}',
                                'buttons'=>[
                                    'delete'=>function($model, $key, $index){

                                        $myurl='index.php?r=client/prihoddelete&ID_PRIHOD='.$key['ID_PRIHOD'];

                                        return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;"  onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                            'title' => Yii::t('app', 'Удалить'),
                                        ]);
                                    },],

                            ],

                            ['label' => 'ID',
                                'attribute' => 'ID_PRIHOD',

                            ],
                            ['label' => 'Товар',
                                'attribute' => 'ID_TOV',
                                'value'=>function($key){
                                    $spdoc=\app\models\Kattov::findOne(['ID_TOV'=>$key->ID_TOV]);
                                    $spdoc=$spdoc->NAME;
                                    return $spdoc;
                                }

                            ],
                            ['label' => 'Примечание',
                                'attribute' => 'PRIM'

                            ],
                            ['label' => 'Количество',
                                'attribute' => 'KOL'

                            ],

                            ['label' => 'Цена закупки',
                                'attribute' => 'PRICE'

                            ],
                            ['label' => 'Цена продажи',
                                'attribute' => 'SELL_PRICE'

                            ],
                            ['label' => 'Сумма',
                                'attribute' => 'SUMM'

                            ],
                            ['label' => 'Дата',
                                'attribute' => 'DATE',
                                'value'=>function($key){

                                    return date('d.m.Y', strtotime($key->DATE));
                                }


                            ],
                            ['label' => 'Срок годности',
                                'attribute' => 'EXPIRATION_DATE',
                                'value'=>function($key){

                                    return date('d.m.Y', strtotime($key->EXPIRATION_DATE));
                                }


                            ],


                        ],]);?>
                </div>
            </div>
        </div>
    </div>
<?
$js = <<<JS

$('.grid-view tbody tr').on('click', function()
{
    window.location = "index.php?r=client/prihod&ID_PRIHOD="+$(this).data('key');
   });

JS;

$this->registerJs($js);?>
