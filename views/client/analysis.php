<?php

use yii\grid\GridView;
use yii\helpers\Html; ?>
<div class="row container-fluid " style="margin-top: 70px;">
    <span style="font-size: 200%">Исследования: <a href="index.php?r=client/visits&pacientId=<?=$pacient->ID_PAC?>" class="clientLink"><?=$pacient->KLICHKA?></a></span>
    <div class="container-fluid row">
        <div class="col-md-4">
            <span style="font-size: 150%">Общий анализ крови </span>
            <?php echo GridView::widget([
                'dataProvider'=>$bloodProvider,

                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} ',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/blood&ID_BLOOD='.$key['ID_BLOOD'].'&ID_PAC='.$key['ID_PAC'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },

                            ],

                    ],



                    ['label' => 'Дата',
                        'attribute'=>'DATE',
                        'value'=>function($key){
                            return $date=date('d.m.Y', strtotime($key->DATE));

                        }

                    ],



                ],


                ]);?>
            <a href="index.php?r=client/blood&ID_PAC=<?=$pacient->ID_PAC?>" style="width: 100%" class="btn btn-success">Добавить</a>
        </div>
        <div class="col-md-4">
            <span style="font-size: 150%">Биохимический анализ крови </span>
            <?php echo GridView::widget([
                'dataProvider'=>$BiohimProvider,

                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} ',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/biohim&ID_BIOHIM='.$key['ID_BIOHIM'].'&ID_PAC='.$key['ID_PAC'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },

                        ],

                    ],



                    ['label' => 'Дата',
                        'attribute' => 'DATE',
                        'value'=>function( $key){
                            return $date=date('d.m.Y', strtotime($key->DATE));

                        }

                    ],



                ],


            ]);?>
            <a href="index.php?r=client/biohim&ID_PAC=<?=$pacient->ID_PAC?>" style="width: 100%" class="btn btn-success">Добавить</a>
        </div>
        <div class="col-md-4">
            <span style="font-size: 150%">Общий анализ мочи</span>
            <?php echo GridView::widget([
                'dataProvider'=>$MochaProvider,

                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} ',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/mocha&ID_MOCHA='.$key['ID_MOCHA'].'&ID_PAC='.$key['ID_PAC'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },

                        ],

                    ],



                    ['label' => 'Дата',
                        'attribute' => 'DATE',
                        'value'=>function( $key){
                            return $date=date('d.m.Y', strtotime($key->DATE));

                        }

                    ],



                ],


            ]);?>
            <a href="index.php?r=client/mocha&ID_PAC=<?=$pacient->ID_PAC?>" style="width: 100%" class="btn btn-success">Добавить</a>
        </div>
    </div>

    <div class="container-fluid row" style="margin-top: 50px;">
        <div class="col-md-4">
            <span style="font-size: 150%">Узи</span>
            <?php echo GridView::widget([
                'dataProvider'=>$UziProvider,

                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} ',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/uzi&ID_UZI='.$key['ID_UZI'].'&ID_PAC='.$key['ID_PAC'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },

                        ],

                    ],



                    ['label' => 'Дата',
                        'attribute' => 'DATE',
                        'value'=>function( $key){
                            return $date=date('d.m.Y', strtotime($key->DATE));

                        }

                    ],



                ],


            ]);?>
            <a href="index.php?r=client/uzi&ID_PAC=<?=$pacient->ID_PAC?>" style="width: 100%" class="btn btn-success">Добавить</a>
        </div>
        <div class="col-md-4">
            <span style="font-size: 150%">Другие исследования</span>
            <?php echo GridView::widget([
                'dataProvider'=>$OtherProvider,

                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} ',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/other&ID_OTHER='.$key['ID_OTHER'].'&ID_PAC='.$key['ID_PAC'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },

                        ],

                    ],



                    ['label' => 'Дата',
                        'attribute' => 'DATE',
                        'value'=>function( $key){
                            return $date=date('d.m.Y', strtotime($key->DATE));

                        }

                    ],



                ],


            ]);?>
            <a href="index.php?r=client/other&ID_PAC=<?=$pacient->ID_PAC?>" style="width: 100%" class="btn btn-success">Добавить</a>
        </div>
        <div class="col-md-4">


        </div>
    </div>

</div>
