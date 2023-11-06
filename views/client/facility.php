<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if($searchModel->ID_SPDOC==5){
    $color='red';
}
?>




<div class="row container-fluid " style="margin-top: 70px;">

<!--    --><?php //$form = ActiveForm::begin(['options'=>['id'=>'facilityForm']]) ?>
<!--    --><?//= $form->field($facility, 'ID_PAC')->textInput(['readonly'=>'readonly'])->label('ID')?>
<!--    --><?//= $form->field($facility, 'ID_DOC')->dropDownList(
//        ArrayHelper::map(\app\models\Doctor::find()->all(), 'ID_DOC', 'NAME'), [
//
//
//        'prompt' => 'Не выбрано...'
//    ])->label('Специалист');?>
<!--    --><?//= $form->field($facility, 'ID_PR')->dropDownList(
//        ArrayHelper::map(\app\models\Price::find()->orderBy("NAME ASC")->all(), 'ID_PR', 'NAME'), [
//
//
//        'prompt' => 'Не выбрано...'
//    ])->label('Услуга');?>
<!--    --><?//= $form->field($facility, 'KOL')->textInput(['autocomplete'=>'off'])->label('Количество')?>
<!---->
<!--    --><?//= $form->field($facility, 'DATA')->textInput(['autocomplete'=>'off'])->label('Дата оказания')?>
<!--    --><?//= $form->field($facility, 'DATASL')->textInput(['autocomplete'=>'off'])->label('Дата следующего оказания (не обязательно)')?>
<!--    <div class="row">-->
<!--        <div class="col-md-2">--><?//= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?><!--</div>-->
<!---->
<!--        --><?php //if ($_GET['ID_PR']!=NULL):?>
<!--            <div class="col-md-10" style="text-align: right">-->
<!--                <a href="index.php?r=client/pricedelete&ID_PR=--><?//=$model->ID_PR?><!--" class="btn btn-danger" >Удалить</a>-->
<!--            </div>-->
<!--        --><?php //endif;?>
<!--    </div>-->
<!--    --><?php //$form = ActiveForm::end();?>
    <?= Html::beginForm([ 'client/new_facility'], 'GET', ['id'=>'test', 'validateOnSubmit' => false]); ?>
    <div class="row">
        <div class="col-md-2">
                <a href="index.php?r=client/visit&ID_VISIT=<?=$_GET['ID_VISIT']?>" class="btn btn-primary">Перейти к визиту</a>
        </div>
        <div class="col-md-3"><?= Html::textInput('DATASL',date("d.m.Y", strtotime("+1 year")),['class' => 'form-control ','style'=>'width:200px;border-color:'.$color.';border-width:4px;' ]); ?> </div>
        <div class="col-md-2"><?= Html::textInput('DISCOUNT',NULL,['class' => 'form-control ','style'=>'width:100%;color:#ff7070;font-weight:bold;',"placeholder"=>"Скидка, %"]); ?> </div>
        <div class="col-md-3"> <?=Html::dropDownList('doctor', 'null', $doc, ['class'=>'form-control']);?></div>
        <div class="col-md-2"> <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'id'=>'btn1', 'style'=>'width:100%;', 'onclick'=>'this.disabled=true;this.form.submit()']) ?></div>
    </div>





    <?php
    echo GridView::widget([
                    'dataProvider'=>$dataProvider,
                    'filterModel'=>$searchModel,

                    'id'=>'price',

                    'columns'=>

                        [
                            ['label' => 'Количество',
                                'attribute' => 'ID_PR',
                                'filter'=>false,
                                'format'=>'raw',
                                'value'=>function($key){
                                    return  Html::textInput($key->ID_PR,'',['class' => 'form-control el-facility_quantity','style'=>'width:200px' ]);
                                }

                            ],
                            ['label' => 'Цена',
                                'attribute' => 'PRICE',

                            ],
                            ['label' => 'Вид',
                                'attribute' => 'ID_SPDOC',
                                'filter'=>[
                                        1=>'Терапия',
                                        2=>'Хирургия',
                                        3=>'УЗИ',
                                        4=>'Медикаменты',
                                        5=>'Вакцинация',
                                        6=>'Дегельминтизация',
                                        7=>'Анализы',
                                        8=>'Корм',
                                ],
                                'value'=>function($key){
                                    $spdoc=\app\models\Spdoc::findOne(['ID_SPDOC'=>$key->ID_SPDOC]);
                                    return $spdoc->SP_DOC;
                                }


                            ],
                            ['label' => 'Наименование',
                                'attribute' => 'NAME',

                            ],





                        ]




                ])

    ?>
    <?= Html::textInput('ID_VISIT',$_GET['ID_VISIT'],['class' => 'form-control ','style'=>'width:200px;border-color:'.$color.';' ]); ?>

    <?php Html::endForm(); ?>
    <div id="msg_pop">
        <a href=""class="msg_close" style="color:#fc4e4e; margin: 0px" onclick="document.getElementById('msg_pop').style.display='none'; return false;">X</a>
        <h4 style="margin-bottom: 5px;">Список услуг визита</h4>
        <?php

            foreach ($uslugi as $item):
                $pr=\app\models\Price::findOne(['ID_PR'=>$item->ID_PR]);
        ?>
            <div class="row" style="margin-left:5px; margin-bottom: 5px;"><?=$pr->NAME?>        (<?=$item->KOL?>)</div>

        <?php endforeach;?>
    </div>
    <script>
$('test').on('beforeSubmit', function()
{
    var $form = $(this);
    console.log('before submit');

    var $submit = $form.find(':submit');
    $submit.html('<span class="fa fa-spin fa-spinner"></span> Processing...');
    $submit.prop('disabled', true);

});

</script>
    <script type="text/javascript">
        var delay_popup = 200;
        var msg_pop = document.getElementById('msg_pop');
        setTimeout("document.getElementById('msg_pop').style.display='block';document.getElementById('msg_pop').className += 'fadeIn';", delay_popup);

    </script>
</div>
<?php
$js = <<<JS

// $('#test').on('submit', function(){
//     alert('AAAAAA');
//     if ($(this).data('requestRunning')) {
//         return false;
//     }
//     $(this).data('requestRunning', true);
    
//     $.post(url, {}, function(json){
//         $(this).data('requestRunning', false);
//     }, 'json');
    
//     return false;
// });


JS;

$this->registerJs($js);?>