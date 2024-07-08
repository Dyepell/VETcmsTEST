<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use TextFiller\TextFiller;
use execut\autosizeTextarea\TextareaWidget;
?>
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

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
		<div class="col-lg-5 clinic-col">
				<?php $form = ActiveForm::begin(['options'=>['id'=>'docTemplateFormForm'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
				<?= $form->field($docTemplate, 'docTemplateId')->textInput(['autocomplete'=>"off", 'readonly'=>'readonly'])?>
                <?= $form->field($docTemplate, 'docTemplateTypeId')->dropDownList(
                        ArrayHelper::map(\app\models\DocTemplateTypeForm::find()->orderBy("templatePseudoName ASC")->all(), 'docTemplateTypeId', 'templatePseudoName'));?>
				<?= $form->field($docTemplate, 'templateName')->textInput(['autocomplete'=>"off"])?>
				<?= $form->field($docTemplate, 'isDefault')->checkbox()?>
                <?= $form->field($docTemplate, 'file')->fileInput(['autocomplete'=>"off"])?>

				<div class="row">
						<div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>
				</div>
				<?php $form = ActiveForm::end();?>
		</div>
        <?if ($docTemplate->docTemplateId <> ''):?>
        <div class="col-md-6 clinic-col">
            <h3>Пример документа</h3>  <? $textFiller->renderButton(); ?>
            <h3>Пустой шаблон: <a href="/DocTemplates/<?=$docTemplate->filePath?>" download><?=$docTemplate->filePath ?></a></h3>
            <h3>Пустой шаблон: <a href="index.php?r=docs/templatedownload&path=<?=$docTemplate->filePath?>&templateName= <?=$docTemplate->templateName?>"> <?=$docTemplate->templateName?> (скачать)</a></h3>

		</div>
        <? endif; ?>

</div>
