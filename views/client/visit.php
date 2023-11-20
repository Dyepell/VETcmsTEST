<?php

use app\models\Doctor;
use app\models\Prihod_tovara;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use app\models\SaleForm;

?>


<script>
$('#visitForm').on('beforeSubmit', function()
{
    var $form = $(this);
    console.log('before submit');

    var $submit = $form.find(':submit');
    $submit.html('<span class="fa fa-spin fa-spinner"></span> Processing...');
    $submit.prop('disabled', true);

});
// 	var btn = document.querySelector('#test');
 
//  btn.addEventListener('submit',function() {

//      btn.classList.toggle('loading');
//     btn.innerText = 'Загрузка';
//     btn.disabled = true;
//      setTimeout(function() {
//          btn.disabled = false;
//      }, 3000);
//  });
</script>

<div class="modal fade" id="sales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавление продажи к визиту</h4>
            </div>
            <div class="modal-body clinic-col">
                <?echo Yii::$app->controller->renderPartial('new_add_sale', compact('model', 'salesProducts', 'doctors')); ?>
            </div>
            <div class="modal-footer">
                <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            </div>
        </div>
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
                if ($_GET['ID_VISIT']!=null){echo GridView::widget([
                    'dataProvider'=>$istbolProvider,
                    'id'=>'istbol',

                    'columns'=>

                        [
                            ['label' => 'ID',
                                'attribute' => 'ID_IST',

                            ],
                            ['label' => 'ID пациента',
                                'attribute' => 'ID_PAC',

                            ],
                            ['label' => 'Дата',
                                'attribute' => 'DIST',

                            ],




                        ],

                    'rowOptions' => function ($model, $key, $index, $grid) {

                        return ['id' => $model['ID_IST'], 'onclick' => 'window.location = "index.php?r=client/istbol&ID_IST="+this.id'];

                    },


                ]);}?>
                <a href="index.php?r=client/istbol&ID_PAC=<?=$visit->ID_PAC?>" class="btn btn-success" style="width: 100%;">Добавить историю</a>
            </div>
            <div class="modal-footer">
                <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="docs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Приложения</h4>
            </div>
            <div class="modal-body" style="text-align: center">

                <a href="index.php?r=client/docagree&ID_VISIT=<?=$visit->ID_VISIT?>" class="btn btn-success" style="margin-bottom: 10px;">Соглашение</a>
                <a href="index.php?r=client/docdolg&ID_VISIT=<?=$visit->ID_VISIT?>" class="btn btn-success" style="margin-bottom: 10px;">Договор возмездного оказания</a>
                <a href="index.php?r=client/docact&ID_VISIT=<?=$visit->ID_VISIT?>" class="btn btn-success">Акт выполненных работ</a>
            </div>
            <div class="modal-footer">
                <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->

            </div>
        </div>
    </div>
</div>






<div class="row container-fluid " style="margin-top: 70px;">
    <h1>Визит <a href="index.php?r=client/visits&pacientId=<?=$pacient->ID_PAC?>&clientId=<?=$pacient->ID_CL?>"><?=$pacient->KLICHKA?></a></h1>
    <div class="col-md-6 p-0">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'visitForm', 'validateOnSubmit' => false]]) ?>
        <div style="display: flex">
    <?= $form->field($visit, 'ID_VISIT')->textInput(['readonly'=>'readonly'])->label('ID визита')?>
    <?= $form->field($visit, 'ID_PAC')->textInput(['readonly'=>'readonly', 'style'=>'margin-left:5px;'])->label('ID пациента')?>
    <?php

    if ($visit->DATE!=NULL){
       echo  $form->field($visit, 'DATE')->textInput(['style'=>'margin-left:10px;'])->label('Дата визита');
    }else{
        echo $form->field($visit, 'DATA')->textInput(['style'=>'margin-left:10px;'])->label('Дата визита');
    }
    ?>


        </div>

        <?= $form->field($visit, 'ID_DIAG')->dropDownList(
            ArrayHelper::map(\app\models\Diagnoz::find()->all(), 'ID_D', 'DIAGNOZ'), [


            'prompt' => 'Не выбрано...'
        ])->label('Диагноз основного заболевания');?>
    <div class="row">
        <div class="col" style="margin-left: 20px;">
           <?php  if ($_GET['ID_VISIT']!=null)
           {echo "<span style=\"font-size: 150%;\">Список услуг</span>";}?>
            <?php
            if ($_GET['ID_VISIT']!=null){echo GridView::widget([
                'dataProvider'=>$FacilityProvider,
                'id'=>'facilities',
                'columns'=>

                    [
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>' {delete}',
                            'buttons'=>[
                                'delete'=>function($model, $key, $index){

                                    $myurl='index.php?r=client/facilitydelete&ID_FAC='.$key['ID_FAC'].'&ID_VISIT='.$key['ID_VISIT'];

                                    return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;"  onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                        'title' => Yii::t('app', 'Удалить'),
                                    ]);
                                },],

                        ],

                        ['label' => 'Специалист',
                            'attribute' => 'ID_DOC',
                            'value'=>function($key){
                                $doc=\app\models\Doctor::findOne(['ID_DOC'=>$key->ID_DOC]);
                                $doc=$doc->NAME;
                                return $doc;
                            }

                        ],
                        ['label' => 'Услуга',
                            'attribute' => 'ID_PR',
                            'value'=>function($key){
                                $pr=\app\models\Price::findOne(['ID_PR'=>$key->ID_PR]);
                                $pr=$pr->NAME;
                                return $pr;
                            }
                        ],
                        ['label' => 'Цена',
                            'attribute' => 'PRICE',

                        ],
                        ['label' => 'Количество',
                            'attribute' => 'KOL',

                        ],
                        [
                            "label"=>"Скидка, %",
                            'attribute'=>'DISCOUNT_PROCENT'
                        ],
                        ['label' => 'Сумма',
                            'attribute' => 'SUMMA',


                        ],



                    ],


                ]);}?>
            <?php
            if ($_GET['ID_VISIT']!=NULL):
            ?>
            <div class="row">
                <div class="col">
<!--                    <span style="font-size: 130%;">ИТОГО без учета скидки: --><?//=$visit->SUMM_BEFORE_DISCOUNT?><!-- руб.</span>-->
                    <br>
                    <span style="font-size: 200%; color: darkred;">ИТОГО: <?=$visit->SUMMAV?> руб.</span>
                    <?php if($visit->DOLG!=0):?>
                        <br>
                        <span style="font-size: 200%; color: darkred;">Долг: <?=$visit->DOLG?> руб.</span>
                    <?php endif;?>
                </div>
                <div class="col-md-5">

            <?php endif;?>
                </div>
            </div>
        </div>
        <?php if($_GET['ID_VISIT']!=NULL):?>
        <div class="row" style="margin-left:10px;">

            <div class="col">
        <a href="index.php?r=client/facility&ID_VISIT=<?=$visit->ID_VISIT?>" class="btn btn-warning">Добавить услуги</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#docs">
            Приложения
        </button>

                <a href="index.php?r=client/pr_visit_facility&ID_VISIT=<?=$visit->ID_VISIT?>" class="btn btn-success">Услуги предыдущего визита</a>


            </div>
        </div>
        <?php endif;?>
    </div>

    </div>


    <div class="col-md-5" style="margin-left: 20px;">
        <?php if($_GET['ID_VISIT']!=NULL):?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#istbol">
            Истории болезни
        </button>
        <a href="index.php?r=client/analysis&ID_PAC=<?=$visit->ID_PAC?>" class="btn btn-primary">Исследования</a>
            <br><span style = "font-size: 150%">Товары к визиту</span>
        <!--//qwerty-->
            <? echo GridView::widget([
                'dataProvider' => $goodsSalesProvider,
                'id'=>'goodsSales',
                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{delete}',
                        'buttons'=>[
                            'delete'=>function($model, $key, $index){
                                $myurl="index.php?r=client/saledelete&ID_SALE=".$key['ID_SALE'];
                                return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                    'title' => Yii::t('app', 'Удалить'),
                                ]);
                            }
                        ],

                    ],
                    'ID_SALE',
                    'good.NAME',
                    'KOL',
                    'SUMM'
                ]
            ]); ?>
            <button type='button' style='margin-top: -10px; width: 100%;' class='btn btn-info' data-toggle='modal' data-target='#sales'>Добавить товар</button><br>

            <?php
            if ($_GET['ID_VISIT']!=null):
                echo "<span style=\"font-size: 150%;\">Оплата</span>";
            echo GridView::widget([
                'dataProvider'=>$oplataProvider,
                'id'=>'oplata',
                'columns'=>
                    [
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>' {delete}',
                            'buttons'=>[
                                'delete'=>function($model, $key, $index){
                                    $myurl='index.php?r=client/oplatadelete&ID_OPL='.$key['ID_OPL'].'&ID_VISIT='.$key['ID_VIZIT'];
                                    return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;"  onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                        'title' => Yii::t('app', 'Удалить'),
                                    ]);
                                },],

                        ],
                        ['label' => 'ID',
                            'attribute' => 'ID_OPL',
                        ],
                        ['label' => 'Вид оплаты',
                            'attribute' => 'VID_OPL',
                            'value'=>function($key){
                            if($key->VID_OPL==0){
                                $result= 'Наличные';
                            }else{
                                $result= 'Б/нал.';
                            }
                            if($key->IsDolg){
                                $result=$result." (оплата долга)";
                            }
                            return $result;
                            }
                        ],
                        ['label' => 'Сумма',
                            'attribute' => 'SUMM',
                        ],
                        ['label' => 'Дата',
                            'attribute' => 'DATE',
                            'value'=>function($key){
                            return date('d.m.Y',strtotime($key->DATE));
                            }

                        ],
                    ],
            ]);endif;?>

        <div style="display: flex">

        <button class="btn-info btn" style="height: 50%;font-weight: bold;margin-top: 25px;">Σ</button> <?= $form->field($visit, 'SUMMAO')->textInput(['style'=>'margin-left:10px;width:70px;'])->label('Оплата', ['style'=>'margin-left:10px; '])?>

        <?=$form->field($visit, 'VIDOPL')->dropDownList([
            '0' => 'Наличные',
            '1' => 'Б/нал',

        ]);?>

        </div>
            <?=$form->field($visit, 'IsDolg')->checkbox(['style'=>'margin-left:10px;margin-top:-30px;transform:scale(1.3);',
                "checked"=>false,
                'labelOptions'=>['style'=>'color:#ff7373; font-size:130%;' ]]);?>
        <?php endif;?>
        <div class="row">
            <div class="col-md-2">

                <?= Html::submitButton('Сохранить',['class'=>'btn btn-success', 'onclick'=>'this.disabled=true;this.form.submit()'])?>

            </div>
        <?php if ($_GET['ID_VISIT']!=NULL):?>
                    <div class="col-md-10" style="text-align: right">
                     <a href="index.php?r=client/visitdelete&ID_VISIT=<?=$visit->ID_VISIT?>" class="btn btn-danger"
                        onclick='return confirm("Вы уверены?")' >Удалить</a>
                    </div>
        <?php endif;?>
        </div>
        <?php $form = ActiveForm::end();?>
    </div>



</div>


    

<script>
$('#visitForm').on('beforeSubmit', function()
{
    var $form = $(this);
    console.log('before submit');

    var $submit = $form.find(':submit');
    $submit.html('<span class="fa fa-spin fa-spinner"></span> Processing...');
    $submit.prop('disabled', true);

});

</script>
    

<?php
$js = <<<JS

function getGet(name) {
    var s = window.location.search;
    s = s.match(new RegExp(name + '=([^&=]+)'));
    return s ? s[1] : false;
}

$('#facilities tbody tr').on('click', function()
{
    var idFac=$(this).data('key');
    window.location = "index.php?r=client/facility_correct&ID_FAC="+$(this).data('key');
    
   });

$('#createCheck').on('click', function () 
{
    $.ajax({
        url:  'index.php?r=ofd/test&ID_VISIT=' + getGet('ID_VISIT'),
        type: 'POST',
            success: function(response) {
                console.log(response);                                                     
            }
        });
    return false;
})

JS;

$this->registerJs($js);?>
