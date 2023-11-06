<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


    <div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
        <h1>Справочник расходников</h1>
        <div class="col">
            <a href="index.php?r=client/expenseadd" class="btn-success btn" style="margin-bottom: 10px;">Добавить расходник</a>



            <div class="col">

                <div   style="">
                    <?php

                    echo GridView::widget([
                        'dataProvider'=>$expense_catalog,

                        'columns'=>[




                            ['label' => 'ID расхода',
                                'attribute' => 'ID_EX',

                            ],
                            ['label' => 'Наименование расхода ',
                                'attribute' => 'ID_PR',
                                'value'=>function($key){
                                    $pricedure=\app\models\Price::findOne(['ID_PR'=>$key->ID_PR]);
                                    return $pricedure->NAME;
                                }

                            ],
                            ['label' => 'Ед. измерения ',
                                'attribute' => 'IZM',
                                'value'=>function($key){
                                    switch ($key->IZM){
                                        case 0:
                                            return 'Шт.';
                                            break;
                                        case 1:
                                            return 'Мл.';
                                            break;
                                    }
                                }

                            ],
                            ['label' => 'Кол-во',
                                'attribute' => 'KOL'

                            ],
                            ['label' => 'Цена',
                                'attribute' => 'PRICE'

                            ],
                            ['label' => 'Сумма',
                                'attribute' => 'SUMM'

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
    window.location = "index.php?r=client/expenseadd&ID_EX="+$(this).data('key');
   });
JS;

$this->registerJs($js);?>