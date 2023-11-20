<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Продажа товара <a href="index.php?r=shop/salecheckspage" class="btn btn-warning">Список чеков</a></h1>
    <div class="col">
        <div class="col"><a href="index.php?r=client/new_add_sale" class="btn btn-success" style="width: 100%; margin-bottom: 10px;">Добавить</a></div>
        <div class="col"><a href="index.php?r=client/newsale" class="btn btn-info" style="width: 100%; margin-bottom: 10px;">Оформление продажи</a></div>
        <div class="col">

            <div >
                <?php

                echo GridView::widget([
                    'dataProvider'=>$SaleProvider,

                    'columns'=>[
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{delete}',
                            'buttons'=>[
                                'delete'=>function($model, $key, $index){

                                    $myurl='index.php?r=client/saledelete&ID_SALE='.$key['ID_SALE'];

                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick=\'return confirm("Вы уверены?")\' style="margin-left: 5px;"></span>', $myurl,[
                                        'title' => Yii::t('app', 'Удалить'),
                                    ]);
                                },],

                        ],

                        ['label' => 'ID продажи',
                            'attribute' => 'ID_SALE',

                        ],
                        ['label' => 'Сотрудник',
                            'attribute' => 'SOTRUDNIK',

                            'value'=>function($key){
                                $spdoc=\app\models\Doctor::findOne(['ID_DOC'=>$key->SOTRUDNIK]);
                                $spdoc=$spdoc->NAME;
                                return $spdoc;
                            }

                        ],

                        ['label' => 'Товар',
                            'attribute' => 'ID_PRIHOD',
                            'value'=>function($key){
                                $spdoc=\app\models\Prihod_tovara::find()->where(['ID_PRIHOD'=>$key->ID_PRIHOD])->joinWith('tovar')->all();
                                $spdoc=$spdoc[0]->tovar->NAME;
                                return $spdoc;
                            }

                        ],
                        ['label' => 'Количество',
                            'attribute' => 'KOL'

                        ],


                        ['label' => 'Сумма',
                            'attribute' => 'SUMM'

                        ],
                        ['label' => 'Скидка, %',
                            'attribute' => 'SKIDKA'

                        ],
                        ['label' => 'Вид оплаты',
                            'attribute' => 'VID_OPL',
                            'value'=>function($key){
                                if($key->VID_OPL==0){
                                    $a='Наличными';
                                }else{
                                    $a='Б/нал';
                                }
                                return $a;
                            }

                        ],
                        ['label' => 'Дата',
                            'attribute' => 'DATE',
                            'value'=>function($key){

                                return $date=date('d.m.Y',strtotime($key->DATE));
                            }

                        ],


                    ],]);?>
            </div>
        </div>
    </div>
</div>

