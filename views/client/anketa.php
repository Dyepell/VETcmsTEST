<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
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
<?= $form->field($model, 'EMAIL')->textInput(['autocomplete'=>'0', 'style' =>'background-color: #ffa3a3'])?>
  <?= $form->field($model, 'document')->fileInput(['autocomplete'=>"off"])?>
<?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php $form = ActiveForm::end();
?>

		<?php  if ($scannedDocs != NULL){
		    echo "<h4>Отсканированные документы</h4>";
				echo GridView::widget([
					'dataProvider' => $scannedDocs,
					'columns'=>[
						['class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {delete}',
							'buttons'=>['view'=>function($model, $key, $index){
									$myurl="index.php?r=client/scanneddocownload&scanId=".$key['scanId'];

									return Html::a('<span class="glyphicon glyphicon-download"></span>', $myurl,[
										'title' => Yii::t('app', 'Просмотр'),
									]);
							},
								'delete'=>function($model, $key, $index){

										$myurl="index.php?r=client/scanneddocdelete&scanId=".$key['scanId'];

										return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
											'title' => Yii::t('app', 'Удалить'),
										]);
								}
							],

						],
						'scanId',
						'scanName'
					]
				]);
		}
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


                    <div class="row docs">
                        <div class="col-md-3">
                            <a href="index.php?r=client/analysis&ID_PAC=<?=$model->ID_PAC?>" class="btn btn-primary">Исследования</a>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="#" id = 'getDoc_<?=$model->ID_PAC?>' class="btn my-btn-dropdown getDoc" style="background-color: #cdddf7;border-bottom-left-radius: 10px; border-top-left-radius:10px; border-bottom-right-radius: 0px; border-top-right-radius:0px">Договор об оказании вет. услуг (старый)</a>
                            <div class="my-dropdown">
                                <a class="btn my-btn-dropdown" style="border-left:1px solid navy;border-bottom-left-radius: 0px; border-top-left-radius:0px; border-bottom-right-radius: 10px; border-top-right-radius:10px">
                                    <i id = 'fontSize_<?=$model->ID_PAC?>' class="fa mfa-caret-down fontSize"><?=($_COOKIE["docUslugiFontSize"] >= 6) ? $_COOKIE["docUslugiFontSize"] : 6?></i>
                                </a>

                                <div class="my-dropdown-content">
                                    <a class = "fontSizeSelector" href="#">6</a>
                                    <a class = "fontSizeSelector" href="#">7</a>
                                    <a class = "fontSizeSelector" href="#">8</a>
                                    <a class = "fontSizeSelector" href="#">9</a>
                                    <a class = "fontSizeSelector" href="#">10</a>
                                    <a class = "fontSizeSelector" href="#">11</a>
                                    <a class = "fontSizeSelector" href="#">12</a>
                                    <a class = "fontSizeSelector" href="#">13</a>
                                    <a class = "fontSizeSelector" href="#">14</a>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="row docs">
                        <div class="col-md-5">
							<? $model->docUslugi->renderButton('Договор об оказании вет. услуг') ?>
                        </div>
                        <div class="col-md-6" style="margin-left: 10px;">
                            <? $model->docRefuse->renderButton('Информационный отказ ') ?>
                        </div>
                    </div>
                    <div class="row docs">
                        <div class="col-md-5">
                            <? $model->docSedation->renderButton('Cогласие на проведение седации') ?>
                        </div>
                        <div class="col-md-6" style="margin-left: 10px;">
                            <? $model->docInter->renderButton('Согласие на вмешательство') ?>
                        </div>
                    </div>
                    <div class="row docs">
                        <div class="col-md-5">
                            <? $model->docHospital->renderButton('Cогласие на стационар') ?>
                        </div>
                        <div class="col-md-6" style="margin-left: 10px;">
                            <? $model->docCritical->renderButton('Инф. о тяжелом состоянии') ?>
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
    <?php
    if (isset($model->ID_PAC)) :
    $js = <<<JS
$('.fontSizeSelector').on('click', function (){
    $('.fontSize').text($(this).text());
});

$('.getDoc').on('click', function (){
    window.location.href = "$app->basePath/web/index.php?r=client/docuslugi&ID_PAC=" + $(this).attr('id').match(/(\d+)/)[0] + "&fontSize=" + $(this).closest('.docs').find('.fontSize').text();
});

JS;
    endif;

    $this->registerJs($js);?>

