<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
?>




<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
<div class="col-md-6">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'clientForm', 'action'=>'clientadd']]) ?>
    <?= $form->field($model, 'ID_CL')->textInput(['readonly'=>'readonly'])?>
<?= $form->field($model, 'FAM')->textInput(['autocomplete'=>"0"])?>
<?= $form->field($model, 'NAME')->textInput(['autocomplete'=>'0'])?>
<?= $form->field($model, 'OTCH')->textInput(['autocomplete'=>'0'])?>
<div style="display:flex">
    <?= $form->field($model, 'CITY')->textInput(['style'=>'width: 150px;', 'autocomplete'=>'off'])?>
    <?= $form->field($model, 'STREET')->textInput(['style'=>'width: 150px;margin-left: 5px;', 'autocomplete'=>'0'])?>
    <?= $form->field($model, 'HOUSE')->textInput(['style'=>'width: 50px;margin-left: 5px;', 'autocomplete'=>'0'])?>
    <?= $form->field($model, 'CORPS')->textInput(['style'=>'width: 50px;margin-left: 5px;', 'autocomplete'=>'0'])?>
    <?= $form->field($model, 'FLAT')->textInput(['style'=>'width: 50px;margin-left: 5px;', 'autocomplete'=>'0'])?>
</div>
<div style="display:flex">
    <?= $form->field($model, 'PHONED')->textInput(['style'=>'width: 210px;', 'autocomplete'=>'0'])?>
    <?= $form->field($model, 'PHONES')->textInput(['style'=>'width: 210px;margin-left:5px', 'autocomplete'=>'0'])?>
</div>
<?= $form->field($model, 'EMAIL')->textInput(['autocomplete'=>'0'])?>
<?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php $form = ActiveForm::end();
?>

</div>
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

<div class="col-md-6 container-fluid">


            <?php if ($_GET['clientId']!='new'){ foreach ($pacModel as $i=> $model):?>

            <div class="col">
                <a href="#" style="width: 100%;text-align: left;margin-top: 10px" onclick="toggle('#menu-<?=$i?>');" class="btn btn-default"><?=$model->KLICHKA?></a>
                <div id="menu-<?=$i?>" class="pacient-form" style="">

 <?php $form = ActiveForm::begin(['options'=>['id'=>$i, 'style'=>'margin:10px;margin-top:0px;padding-top: 10px;padding-bottom: 10px;']]) ?>
 <div style="display:flex">
<?= $form->field($model, '[$i]ID_PAC')->textInput(['readonly'=>'readonly', 'style'=>'width: 80px;'])?>
<?= $form->field($model, '[$i]ID_VID')->dropDownList(
    ArrayHelper::map(\app\models\Vid::find()->all(), 'ID_VID', 'NAMEVID'), [
    'options' => [
        $model->ID_POR => ['selected' => true]
    ],
    'style'=>'margin-left:5px;',
    'prompt' => 'Не выбрано...'
])->label('Вид животного');?>
<?= $form->field($model, '[$i]ID_POR')->dropDownList(
    ArrayHelper::map(\app\models\Poroda::find()->where(['ID_VID'=>$model->ID_VID])->all(), 'ID_POR', 'NAMEPOR'), [
    'options' => [

        $model->ID_POR => ['selected' => true]
    ],
    'style'=>'width:170px;margin-left:10px;',
    'prompt' => 'Не выбрано/метис...'
])->label('Порода');?>
<?= $form->field($model, '[$i]KLICHKA')->textInput(['autocomplete'=>'off','style'=>'width: 150px;margin-left:5px;'])?>
</div>


<div style="display:flex">
<?= $form->field($model, '[$i]BDAY')->textInput(['autocomplete'=>'off', 'style'=>'width:100px;'])?>
<?= $form->field($model, '[$i]VOZR')->textInput(['autocomplete'=>'off', 'style'=>'width:100px;margin-left:15px;'])->label('Возраст',['style'=>'margin-left:15px;']);?>
<?= $form->field($model, '[$i]POL')->textInput(['autocomplete'=>'off', 'style'=>'width:50px;margin-left:15px;'])->label('Пол',['style'=>'margin-left:15px;'])?>
</div>


                    <div class="row">
                        <div class="col-md-3">
                            <a href="index.php?r=client/analysis&ID_PAC=<?=$model->ID_PAC?>" class="btn btn-primary">Исследования</a>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3" style="text-align: right;">
                            <a href="index.php?r=client/docuslugi&ID_PAC=<?=$model->ID_PAC?>" style="margin-left: -110px;" class="btn btn-primary">Договор об оказании вет. услуг</a>
                        </div>

                    </div>



<?= $form->field($model, '[$i]PRIMECH')->textarea(['rows'=>3])?>

                    <div class="row">
                            <div class="col-md-3">
                            <?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
                            </div>
                            <div class="col-md-6">
                            <a href="index.php?r=client/visits&pacientId=<?=$model->ID_PAC?>&clientId=<?=$model->ID_CL?>" class="btn btn-primary" style="width:100%;">Визиты пациента</a>
                            </div>
                            <div class="col-md-3" style="text-align: right;">
                            <a class="btn btn-danger" href="index.php?r=client/pacientdelete&clientId=<?=$model->ID_CL?>&deletePacient=<?=$model->ID_PAC?>"  onclick='return confirm("Вы уверены?")'>Удалить</a>
                            </div>

                    </div>
<?php $form = ActiveForm::end();?>


                </div>

            </div>








<?php endforeach;}
if ($_GET['clientId']!='new'){?>
    <div class="col">
        <a href="#" style="width: 100%;text-align: center; margin-top: 15px" onclick="toggle('#menu-9999');"  class="btn btn-success">Добавить пациента</a>
        <div id="menu-9999" class="pacient-form" style="">

            <?php  $form = ActiveForm::begin(['options'=>[ 'style'=>'margin:10px;margin-top:0px;padding-top: 10px;padding-bottom: 10px;']]) ?>

            <?= $form->field($newPacient, 'ID_CL')->textInput(['readonly'=>'readonly', 'value'=>$model->ID_CL])?>
            <div style="display:flex">
            <?= $form->field($newPacient, 'ID_PAC')->textInput(['readonly'=>'readonly', 'style'=>'width: 80px;'])?>
            <?= $form->field($newPacient, 'ID_VID')->dropDownList(
                ArrayHelper::map(\app\models\Vid::find()->all(), 'ID_VID', 'NAMEVID'), [
                'options' => [
                    $newPacient->ID_POR => ['selected' => true]
                ],
                'style'=>'margin-left:5px;',
                'prompt' => 'Не выбрано...'
            ])->label('Вид животного');?>
            <?= $form->field($newPacient, 'ID_POR')->dropDownList(
                ArrayHelper::map(\app\models\Poroda::find()->all(), 'ID_POR', 'NAMEPOR'), [
                'options' => [
                    $newPacient->ID_POR => ['selected' => true]
                ],
                'style'=>'width:170px;margin-left:10px;',
                'prompt' => 'Не выбрано/метис...'
            ])->label('Порода');?>
            <?= $form->field($newPacient, 'KLICHKA')->textInput(['autocomplete'=>'off','style'=>'width: 150px;margin-left:5px;'])?>

            </div>

            <div style="display:flex">
            <?= $form->field($newPacient, 'BDAY')->textInput(['autocomplete'=>'off', 'style'=>'width:100px;'])?>
            <?= $form->field($newPacient, 'VOZR')->textInput(['autocomplete'=>'off', 'style'=>'width:100px;margin-left:15px;'])->label('Возраст',['style'=>'margin-left:15px;']);?>
            <?= $form->field($newPacient, 'POL')->textInput(['autocomplete'=>'off', 'style'=>'width:50px;margin-left:15px;'])->label('Пол',['style'=>'margin-left:15px;'])?>
            </div>
            <?= $form->field($newPacient, 'ID_LDOC')->dropDownList(
                ArrayHelper::map(\app\models\Doctor::find()->all(), 'ID_DOC', 'NAME'), [
                'options' => [
                    $newPacient->ID_LDOC => ['selected' => true]
                ],
                'prompt' => 'Не выбрано...'
            ])->label('Лечащий врач');?>
            <?= $form->field($newPacient, 'PRIMECH')->textarea(['rows'=>3])?>
            <?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
            <?php $form = ActiveForm::end();?>


        </div>

    </div>
    <?php }?>

