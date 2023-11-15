<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>


<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <a href="index.php?r=shop/downloadscanner" class="btn btn-info" style="width: 100%; margin-bottom: 10px;">Скачать приложение-сканер для Android</a>

    <?if ($salesChecks != NULL) { echo GridView::widget([
            'dataProvider' => $salesChecks,
            'columns'=>[
//                ['class' => 'yii\grid\ActionColumn',
//                    'template'=>'{view} {delete}',
//                    'buttons'=>['view'=>function($model, $key, $index){
//                        $myurl="index.php?r=clinic%2Fbrandimage&id=".$key['id'];
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
//                            'title' => Yii::t('app', 'Просмотр'),
//                        ]);
//                    },
//                        'delete'=>function($model, $key, $index){
//
//                            $myurl="index.php?r=clinic%2Fbrandimagedelete&id=".$key['id'];
//
//                            return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
//                                'title' => Yii::t('app', 'Удалить'),
//                            ]);
//                        }
//                    ],
//
//                ],
                'id',
                'saleId',
                'shiftNum',
                'checkNum',
                'fiscalDocNum',
                'fiscalSign',
                'date'
            ]
        ]);
    }?>
</div>