<?php
use yii\grid\GridView;
?>



<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Прейскурант</h1>
    <script>
        $(function() {
            $("div[id*='menu-']").hide();
        });

        function toggle(objName) {
            var obj = $(objName),
                blocks = $("div[id*='menu-']");

            if (obj.css("display") != "none") {
                obj.animate({ height: 'hide' }, 500);
            } else {
                var visibleBlocks = $("div[id*='menu-']:visible");

                if (visibleBlocks.length < 1) {
                    obj.animate({ height: 'show' }, 500);
                } else {
                    $(visibleBlocks).animate({ height: 'hide' }, 500, function() {
                        obj.animate({ height: 'show' }, 500);
                    });
                }
            }
        }


    </script>
    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-0');" class="btn btn-default">Терапия</a>
        <div id="menu-0" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$teraphyProvider,

                'columns'=>

                    [


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],
                        ['label' => 'Количество',
                            'attribute' => 'KOL',
                            'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }


                            }
                        ],

                ],]);?>
        </div>
    </div>


    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-1');" class="btn btn-default">Хирургия</a>
        <div id="menu-1" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$surgaryProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>


    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-2');" class="btn btn-default">Узи</a>
        <div id="menu-2" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$uziProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>

    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-3');" class="btn btn-default">Медикаменты</a>
        <div id="menu-3" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$medicinesProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>


    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-4');" class="btn btn-default">Вакцинация</a>
        <div id="menu-4" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$vakcineProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>
    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-5');" class="btn btn-default">Дегельминтизация</a>
        <div id="menu-5" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$degProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>


    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-6');" class="btn btn-default">Анализы</a>
        <div id="menu-6" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$analysisProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>
    <div class="col">
        <a href="#" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" onclick="toggle('#menu-7');" class="btn btn-default">Корм</a>
        <div id="menu-7" class="pacient-form" style="">
            <?php

            echo GridView::widget([
                'dataProvider'=>$feedProvider,

                'columns'=>[


                    ['label' => 'Дата ',
                        'attribute' => 'DATA'

                    ],
                    ['label' => 'Цена',
                        'attribute' => 'PRICE',

                    ],
                    ['label' => 'Вид услуги',
                        'attribute' => 'ID_SPDOC',
                        'value'=>function($key){
                            $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                            $spdoc=$spdoc->SP_DOC;
                            return $spdoc;
                        }

                    ],
                    ['label' => 'Наименование услуги',
                        'attribute' => 'NAME',

                    ],['label' => 'Количество',
                        'attribute' => 'KOL',
                        'value'=>function($key){
                            if($key->IsCount){
                                if($key->IZM==1){
                                    $izm="Мл";
                                }else{
                                    $izm="Шт";
                                }
                                return $key->KOL."($izm)";
                            }

                        }
                    ],

                ],]);?>
        </div>
    </div>


        <a href="index.php?r=client/addprice" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" class="btn btn-success">Добавить услугу</a>



</div>

<?php
$js = <<<JS

$('.grid-view tbody tr').on('click', function()
{
    window.location = "index.php?r=client/addprice&ID_PR="+$(this).data('key');
   });
JS;

$this->registerJs($js);?>
