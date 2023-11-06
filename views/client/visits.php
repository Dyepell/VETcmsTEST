<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use yii\grid\GridView;
?>
<div class="row container-fluid " style="margin-top: 70px;">

    <span style="font-size: 200%;"><?=$pacient->KLICHKA?> </span>
    <span style="font-size: 130%;"><a href="index.php?r=client/anketa&clientId=<?=$pacient->ID_CL?>">(<?=$client->FAM.' '.$client->NAME.' '.$client->OTCH?>)</a></span>
    <a href="index.php?r=client/visit&ID_PAC=<?=$pacient->ID_PAC?>" class="btn btn-success">Новый визит</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#istbol">Истории болезни</button>
    <a href="index.php?r=client/analysis&ID_PAC=<?=$_GET['pacientId']?>" class="btn btn-primary">Исследования</a>

    <?php echo GridView::widget([
            'dataProvider'=>$dataProvider,
            'id'=>'1',
            'columns'=>[

                ['class' => 'yii\grid\SerialColumn'],

                ['label' => 'Дата визита',
                    'attribute' => 'DATE',
                    'value'=>function($key){
                        if($key->DATE==NULL){
                            $date=$key->DATA;
                        }else{
                            $date=date('d.m.Y', strtotime($key->DATE));
                        }
                    return $date;
                    }

                ],

                ['label' => 'Сумма визита',
                    'attribute' => 'SUMMAV',

                ],
                ['label' => 'Долг',
                    'attribute' => 'DOLG',

                ],
                ['label' => 'Дата оплаты',
                    'attribute' => 'DATA_OPL',
                    'value'=>function($key){
                    if($key->DATA_OPL!=NULL){
                        return $key->DATA_OPL;
                    }else{
                        return $key->DATE_OPL;
                    }

                    }

                ],


                ['label' => 'Диагноз',
                    'attribute' => 'ID_DIAG',
                    'value'=>function($key){
                        $diagnoz=\app\models\Diagnoz::findOne(['ID_D'=>$key->ID_DIAG]);
                        $diagnoz=$diagnoz->DIAGNOZ;
                    return $diagnoz;
                    }


                ]
            ],]);?>
</div>
<div class="row container-fluid p-0">
<div class="col-md-6">
    <span style="font-size: 200%;">Вакцинация</span>

    <?php echo GridView::widget([
        'dataProvider'=>$vakcineProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns'=>[
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => 'Дата оказания',
                'attribute' => 'DATA',
                'value'=>function($key){

                    return date('d.m.Y', strtotime($key->DATA));
                }

            ],
            ['label' => 'Дата следующего оказания',
                'attribute' => 'DATASL',
                'value'=>function($key){

                    return date('d.m.Y', strtotime($key->DATASL));
                }

            ],
            ['label' => 'Наименование',
                'attribute' => 'ID_PR',
                'value'=>function($key){
                    $procedure=\app\models\Price::findOne(['ID_PR'=>$key->ID_PR]);
                    return $procedure->NAME;
                }

            ],

        ],
        ]);?>
</div>

</div>

<div class="modal fade" id="istbol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Истории болезни</h4>
            </div>
            <div class="modal-body">
                <?php
                echo GridView::widget([
                    'dataProvider'=>$istbolProvider,
                    'id'=>'istbol',

                    'columns'=>

                        [


                            ['label' => 'Дата',
                                'attribute' => 'DIST',

                            ],




                        ],

                    'rowOptions' => function ($model, $key, $index, $grid) {

                        return ['id' => $model['ID_IST'], 'onclick' => 'window.location = "index.php?r=client/istbol&ID_IST="+this.id'];

                    },


                ]);?>
                <a href="index.php?r=client/istbol&ID_PAC=<?=$_GET['pacientId']?>" class="btn btn-success" style="width: 100%;">Добавить историю</a>
            </div>
            <div class="modal-footer">
                <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->

            </div>
        </div>
    </div>
</div>


<?php
$js = <<<JS

$('#1 tbody tr').on('click', function()
{
    window.location = "index.php?r=client/visit&ID_VISIT="+$(this).data('key');
   });
JS;

$this->registerJs($js);?>
