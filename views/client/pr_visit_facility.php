<?php

use yii\grid\GridView;
use yii\helpers\Html; ?>
<div class="row container-fluid" style="text-align: center; margin-top: 80px;">
    <?php if ($_GET['ID_VISIT']!=null):?>
        <?= Html::beginForm(['client/pr_facility', 'id' => 'prFacility', 'name'=>'form1'], 'GET'); ?>
        <?=Html::dropDownList('doctor', 'null', $doc, ['class'=>'form-control', 'id'=>'dropdown']);?>
        <?php
        echo GridView::widget([
            'dataProvider'=>$prFacilityProvider,
            'id'=>'prFac',

            'columns'=>

                [
                    [
                        'format'=>'raw',
                        'value'=>function($key){
                            return  Html::checkbox($key->ID_FAC,'',['class' => 'form-check-input' ]);
                        }

                    ],

                    ['label' => 'Услуга',
                        'attribute' => 'ID_PR',
                        'value'=>function($key){
                            $pr=\app\models\Price::findOne(['ID_PR'=>$key->ID_PR]);
                            return $pr->NAME;
                        }

                    ],
                    ['label' => 'Кол.',
                        'attribute' => 'KOL',

                    ],

                    ['label' => 'Дата',
                        'attribute' => 'DATA',
                        'value'=>function($key){
                            return date('d.m.Y', strtotime($key->DATA));
                        }

                    ],




                ],




        ]);endif;?>
    <?= Html::textInput('ID_VISIT',$_GET['ID_VISIT'],['class' => 'form-control ','style'=>'width:200px;border-color:'.$color.';display:none;' ]); ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'id'=>'btn1', 'style'=>'width:100%;']) ?>
    <?php Html::endForm(); ?>
</div>
