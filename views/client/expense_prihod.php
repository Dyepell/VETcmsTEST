<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


    <div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
        <h1>Приход расходников</h1>
        <div class="col">
            <a href="index.php?r=client/expense_prihodadd" class="btn-success btn" style="margin-bottom: 10px;">Добавить приход</a>



            <div class="col">

                <div   style="">
                    <?php

                    echo GridView::widget([
                        'dataProvider'=>$expense_prihod,

                        'columns'=>[




                            ['label' => 'ID прихода',
                                'attribute' => 'ID_EXPR',

                            ],
                            ['label' => 'Расход',
                                'attribute' => 'ID_PR',
                                'value'=>function($key){

                                    $pricedure=\app\models\Price::findOne(['ID_PR'=>$key->ID_PR]);
                                    return $pricedure->NAME;
                                }

                            ],

                            ['label' => 'Кол-во',
                                'attribute' => 'KOL'

                            ],

                            ['label' => 'Дата',
                                'attribute' => 'DATE',
                                'value'=>function($key){
                                return $date=date('d.m.Y', strtotime($key->DATE));
                                }

                            ],


                        ],]);?>
                </div>
            </div>
        </div>
    </div>

<?php
$js = <<<JS

$('.grid-view tbody tr').on('click', function()
{
    window.location = "index.php?r=client/expense_prihodadd&ID_EXPR="+$(this).data('key');
   });
JS;

$this->registerJs($js);?>