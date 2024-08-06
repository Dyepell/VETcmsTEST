<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="row container-fluid " style="margin-top: 70px; padding: 0px; padding-bottom: 500px;">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'istbolNew']]) ?>


    <div class="col-md-6 history" style="border-right: 1px; border-right: solid;">
        <? if($_GET['idIst'] != null): ?>
            <h3 style="color: red">Запись от <?=date('d.m.y', strtotime($istbol->date))?></h3>
        <? else: ?>
            <h3>Новая запись</h3>
        <? endif; ?>

        <div class="row breadcrumbs">
            <a href="#anamnez" class="anchorLink">Анамнез <span class = 'anamnezCounter' style="color: red"></span></a> /
            <a href="#inspection" class="anchorLink">Осмотр <span class = 'inspectionCounter' style="color: red"></span></a> /
            <a href="#diagnos" class="anchorLink">Диагнозы <span class = 'diagnosesCounter' style="color: red"></span></a> /
            <a href="#diagnostics" class="anchorLink">Диагностика <span class = 'diagnosticsCounter' style="color: red"></span></a> /
            <a href="#comments" class="anchorLink">Рекомендации и коментарии <span class = 'commentsCounter' style="color: red"></span></a>
						<?= Html::submitButton('Сохранить',['class'=>'btn btn-success', 'style' => 'padding: 0px; margin-top: 2px; float: right'])?>
        </div>
        <label for="r1" class="bar1" style="visibility: hidden">1</label>
        <div class="historyPart" id = "anamnez">
            <h4 class="headline">Анамнез</h4>
            <?= $form->field($istbol, 'complaints')->textarea(['rows' => '6'])?>
            <?= $form->field($istbol, 'howGet')->textInput()?>
            <?= $form->field($istbol, 'petCare')->textInput()?>
            <?= $form->field($istbol, 'castration')->textInput()?>
            <?= $form->field($istbol, 'deworming')->textInput()?>
            <?= $form->field($istbol, 'otherPets')->textInput()?>
            <?= $form->field($istbol, 'chronic')->textInput()?>
            <?= $form->field($istbol, 'past')->textInput()?>
            <?= $form->field($istbol, 'longTern')->textInput()?>
            <?= $form->field($istbol, 'appetite')->textInput()?>
            <?= $form->field($istbol, 'thirst')->textInput()?>
            <?= $form->field($istbol, 'poop')->textInput()?>
            <?= $form->field($istbol, 'diurese')->textInput()?>
        </div>

        <div class="historyPart" id = "inspection">
            <h4 class="headline">Осмотр <span id = 'inspectionCounter'>0</span></h4>
            <?= $form->field($istbol, 'status')->textInput()?>
            <?= $form->field($istbol, 'temperature')->textInput()?>
            <?= $form->field($istbol, 'weight')->textInput()?>
            <?= $form->field($istbol, 'fatness')->textInput()?>
            <?= $form->field($istbol, 'membranes')->textInput()?>
            <?= $form->field($istbol, 'oralCavity')->textInput()?>
            <?= $form->field($istbol, 'heart')->textInput()?>
            <?= $form->field($istbol, 'breath')->textInput()?>
            <?= $form->field($istbol, 'abdomen')->textInput()?>
            <?= $form->field($istbol, 'leather')->textInput()?>
            <?= $form->field($istbol, 'lymph')->textInput()?>
            <?= $form->field($istbol, 'genitals')->textInput()?>
            <?= $form->field($istbol, 'mammary')->textInput()?>
            <?= $form->field($istbol, 'dehydration')->textInput()?>
            <?= $form->field($istbol, 'mental')->textInput()?>
            <?= $form->field($istbol, 'pathological')->textInput()?>
        </div>

        <div class="historyPart" id = 'diagnos'>
            <h4 class="headline">Диагнозы </h4>
            <?= $form->field($istbol, 'preDiagnos')->textInput()?>
            <?= $form->field($istbol, 'diffDiagnos')->textInput()?>
            <?= $form->field($istbol, 'exDiagnos')->textInput()?>
            <?= $form->field($istbol, 'conPathology')->textInput()?>
            <?= $form->field($istbol, 'finalDiagnos')->textInput()?>
        </div>


        <div class="historyPart" id = 'diagnostics'>
            <h4 class="headline">Диагностика (лабораторная, визуальная, инструментальная) </h4>
            <?= $form->field($istbol, 'perfDiagnostics')->textarea(['rows' => '6'])?>
            <?= $form->field($istbol, 'recDiagnostics')->textarea(['rows' => '6'])?>
            <?= $form->field($istbol, 'addSurveys')->textarea(['rows' => '6'])?>
            <?= $form->field($istbol, 'perfManipulations')->textarea(['rows' => '6'])?>
        </div>

        <div class="historyPart" id = 'comments'>
            <h4 class="headline">Рекомендации и комментарии <span id = 'commentsCounter'>0</span></h4>
            <?= $form->field($istbol, 'recForOwner')->textarea(['rows' => '6'])?>
            <?= $form->field($istbol, 'commentsForDoc')->textarea(['rows' => '6'])?>
        </div>


        <?php $form = ActiveForm::end();?>
    </div>
    <div class="col-md-6 history" style="padding: 0px;">
        <h3>Предыдущие записи</h3>
        <div class="breadcrumbs">
            <? foreach ($previousIstbol as $key=>$prevIstbol): ?>
                <label for="r<?=$key + 1?>" class="bar" id="b<?=$key?>" <?=($key == count($previousIstbol) -1 ) ? "style='color: red'" : ''?>><?=date('d.m.y', strtotime($prevIstbol['date']))?></label>
            <? endforeach; ?>
<!--            <label for="r1" class="bar">1</label>-->
<!--            <label for="r2" class="bar">2</label>-->
<!--            <label for="r3" class="bar">3</label>-->
<!--            <label for="r4" class="bar" style="color: red">4</label>-->
        </div>
        <label for="r1" class="bar1" style="visibility: hidden">1</label>

        <div class="historyPart" id = "anamnez">
            <div class="slider middle">
                <div class="slides">

                    <? foreach ($previousIstbol as $key=>$prevIstbol): ?>
                        <input type="radio" name="r" id="r<?=$key + 1?>" <?=($key == count($previousIstbol) -1 ) ? "checked" : ''?>>
                    <? endforeach; ?>
<!--                    <input type="radio" name="r" id="r1">-->
<!--                    <input type="radio" name="r" id="r2">-->
<!--                    <input type="radio" name="r" id="r3">-->
<!--                    <input type="radio" name="r" id="r4" checked>-->


                    <? foreach ($previousIstbol as $key=>$prevIstbol): ?>
                        <div class="slide <?=($key == 0) ? "s1" : ''?> history<?=$key?>">
                                <div class="historyPart anamnezInputs" id = "anamnez">
                                    <h4 class="headline">Анамнез</h4>
                                    <?= $form->field($istbol, 'complaints')->textarea(['rows' => '6', 'readonly' => 'true', 'value' => $prevIstbol['complaints']])?>
                                    <?= $form->field($istbol, 'howGet')->textInput(['readonly' => 'true', 'value' => $prevIstbol['howGet']])?>
                                    <?= $form->field($istbol, 'petCare')->textInput(['readonly' => 'true', 'value' => $prevIstbol['petCare']])?>
                                    <?= $form->field($istbol, 'castration')->textInput(['readonly' => 'true', 'value' => $prevIstbol['castration']])?>
                                    <?= $form->field($istbol, 'deworming')->textInput(['readonly' => 'true', 'value' => $prevIstbol['deworming']])?>
                                    <?= $form->field($istbol, 'otherPets')->textInput(['readonly' => 'true', 'value' => $prevIstbol['otherPets']])?>
                                    <?= $form->field($istbol, 'chronic')->textInput(['readonly' => 'true', 'value' => $prevIstbol['chronic']])?>
                                    <?= $form->field($istbol, 'past')->textInput(['readonly' => 'true', 'value' => $prevIstbol['past']])?>
                                    <?= $form->field($istbol, 'longTern')->textInput(['readonly' => 'true', 'value' => $prevIstbol['longTern']])?>
                                    <?= $form->field($istbol, 'appetite')->textInput(['readonly' => 'true', 'value' => $prevIstbol['appetite']])?>
                                    <?= $form->field($istbol, 'thirst')->textInput(['readonly' => 'true', 'value' => $prevIstbol['thirst']])?>
                                    <?= $form->field($istbol, 'poop')->textInput(['readonly' => 'true', 'value' => $prevIstbol['poop']])?>
                                    <?= $form->field($istbol, 'diurese')->textInput(['readonly' => 'true', 'value' => $prevIstbol['diurese']])?>
                                </div>

                                <div class="historyPart inspectionInputs" id = "inspection">
                                    <h4 class="headline">Осмотр</h4>
                                    <?= $form->field($istbol, 'status')->textInput(['readonly' => 'true', 'value' => $prevIstbol['status']])?>
                                    <?= $form->field($istbol, 'temperature')->textInput(['readonly' => 'true', 'value' => $prevIstbol['temperature']])?>
                                    <?= $form->field($istbol, 'weight')->textInput(['readonly' => 'true', 'value' => $prevIstbol['weight']])?>
                                    <?= $form->field($istbol, 'fatness')->textInput(['readonly' => 'true', 'value' => $prevIstbol['fatness']])?>
                                    <?= $form->field($istbol, 'membranes')->textInput(['readonly' => 'true', 'value' => $prevIstbol['membranes']])?>
                                    <?= $form->field($istbol, 'oralCavity')->textInput(['readonly' => 'true', 'value' => $prevIstbol['oralCavity']])?>
                                    <?= $form->field($istbol, 'heart')->textInput(['readonly' => 'true', 'value' => $prevIstbol['heart']])?>
                                    <?= $form->field($istbol, 'breath')->textInput(['readonly' => 'true', 'value' => $prevIstbol['breath']])?>
                                    <?= $form->field($istbol, 'abdomen')->textInput(['readonly' => 'true', 'value' => $prevIstbol['abdomen']])?>
                                    <?= $form->field($istbol, 'leather')->textInput(['readonly' => 'true', 'value' => $prevIstbol['leather']])?>
                                    <?= $form->field($istbol, 'lymph')->textInput(['readonly' => 'true', 'value' => $prevIstbol['lymph']])?>
                                    <?= $form->field($istbol, 'genitals')->textInput(['readonly' => 'true', 'value' => $prevIstbol['genitals']])?>
                                    <?= $form->field($istbol, 'mammary')->textInput(['readonly' => 'true', 'value' => $prevIstbol['mammary']])?>
                                    <?= $form->field($istbol, 'dehydration')->textInput(['readonly' => 'true', 'value' => $prevIstbol['dehydration']])?>
                                    <?= $form->field($istbol, 'mental')->textInput(['readonly' => 'true', 'value' => $prevIstbol['mental']])?>
                                    <?= $form->field($istbol, 'pathological')->textInput(['readonly' => 'true', 'value' => $prevIstbol['pathological']])?>
                                </div>

                                <div class="historyPart diagnosInputs" id = 'diagnos'>
                                    <h4 class="headline">Диагнозы</h4>
                                    <?= $form->field($istbol, 'preDiagnos')->textInput(['readonly' => 'true', 'value' => $prevIstbol['preDiagnos']])?>
                                    <?= $form->field($istbol, 'diffDiagnos')->textInput(['readonly' => 'true', 'value' => $prevIstbol['diffDiagnos']])?>
                                    <?= $form->field($istbol, 'exDiagnos')->textInput(['readonly' => 'true', 'value' => $prevIstbol['exDiagnos']])?>
                                    <?= $form->field($istbol, 'conPathology')->textInput(['readonly' => 'true', 'value' => $prevIstbol['conPathology']])?>
                                    <?= $form->field($istbol, 'finalDiagnos')->textInput(['readonly' => 'true', 'value' => $prevIstbol['finalDiagnos']])?>
                                </div>


                                <div class="historyPart diagnosticsInputs" id = 'diagnostics'>
                                    <h4 class="headline">Диагностика (лабораторная, визуальная, инструментальная)</h4>
                                    <?= $form->field($istbol, 'perfDiagnostics')->textarea(['rows' => '6','readonly' => 'true', 'value' => $prevIstbol['perfDiagnostics']])?>
                                    <?= $form->field($istbol, 'recDiagnostics')->textarea(['rows' => '6', 'readonly' => 'true', 'value' => $prevIstbol['recDiagnostics']])?>
                                    <?= $form->field($istbol, 'addSurveys')->textarea(['rows' => '6', 'readonly' => 'true', 'value' => $prevIstbol['addSurveys']])?>
                                    <?= $form->field($istbol, 'perfManipulations')->textarea(['rows' => '6', 'readonly' => 'true', 'value' => $prevIstbol['perfManipulations']])?>
                                </div>

                                <div class="historyPart commentsInputs" id = 'comments'>
                                    <h4 class="headline">Рекомендации и комментарии</h4>
                                    <?= $form->field($istbol, 'recForOwner')->textarea(['rows' => '6', 'readonly' => 'true', 'value' => $prevIstbol['recForOwner']])?>
                                    <?= $form->field($istbol, 'commentsForDoc')->textarea(['rows' => '6', 'readonly' => 'true', 'value' => $prevIstbol['commentsForDoc']])?>
                                </div>
                            </div>
                    <? endforeach; ?>

                </div>

            </div>

        </div>
    </div>


</div>

<script>

    function countChangedInputs(inputs){
        let counter = 0;
        let backColor = '#fcd056';
        $.each(inputs, function (index, div){

            if ($(this).attr('value')){
                counter = counter + 1;
                $(this).css('background-color', backColor);
            }
            if ($(this).text()){
                $(this).css('background-color', backColor);
                counter = counter + 1;
            }
        });

        return counter;
    }

    function printCount(counterClass, inputs){
        let counter = countChangedInputs(inputs.find($("input"))) + countChangedInputs(inputs.find($("textarea")));

        if (counter > 0) {
            $('.' + counterClass).text("(" + counter  + ")");
        } else {
            $('.' + counterClass).text("");
        }
    }

    $('.bar').on('click', function () {
        $('.bar').css('color', '#333333');
        $(this).css('color', 'red');

        let str = ($(this).attr('id'));
        let slideNumber = str.match(/(\d+)/);

        let slide = $('.history' + slideNumber);

        let anamnezInputs = slide.find('.anamnezInputs');
        let inspectionInputs = slide.find('.inspectionInputs');
        let diagnosInputs = slide.find('.diagnosInputs');
        let diagnosticsInputs = slide.find('.diagnosticsInputs');
        let commentsInputs = slide.find('.commentsInputs');

        printCount('anamnezCounter', anamnezInputs);
        printCount('inspectionCounter', inspectionInputs);
        printCount('diagnosesCounter', diagnosInputs);
        printCount('diagnosticsCounter', diagnosticsInputs);
        printCount('commentsCounter', commentsInputs);
    });

    jQuery(function(){
        $('.bar').last().click();
    });
</script>