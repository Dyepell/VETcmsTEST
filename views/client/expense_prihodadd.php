<?php


//$catalog=\app\models\Expense_catalog::find()->all();
//$ex=[];
//foreach ($catalog as $item){
//    $price=\app\models\Price::findOne(['ID_PR'=>$item->ID_PR]);
//    $ex[$item->ID_EX]=$price->NAME.' (ID='.$item->ID_EX.')';
//}


use yii\helpers\ArrayHelper;
use yii\helpers\Html;use yii\widgets\ActiveForm; ?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <?php $form = ActiveForm::begin(['options'=>['id'=>'expenseForm']]) ?>
    <?= $form->field($model, 'ID_EXPR')->textInput(['readonly'=>'readonly'])->label('ID прихода')?>
    <?= $form->field($model, 'DATE')->textInput(['autocomplete'=>"off"])->label('Дата')?>
<!--    --><?//= $form->field($model, 'ID_EX')->dropDownList(
//       $ex, [
//
//
//
//    ])->label('Расходник');?>
    <?= $form->field($model, 'ID_PR')->dropDownList(
        ArrayHelper::map(\app\models\Price::find()->where(['IsCount'=>1])->all(), 'ID_PR', 'NAME'), [

        'style'=>'margin-left:5px;',
        'prompt' => 'Не выбрано...'
    ])->label('Расходник');?>

    <?= $form->field($model, 'KOL')->textInput(['autocomplete'=>'off'])->label('Количество')?>


    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

        <?php if ($_GET['ID_PR']!=NULL):?>
            <div class="col-md-10" style="text-align: right">
                <a href="index.php?r=client/pricedelete&ID_PR=<?=$model->ID_EX?>" class="btn btn-danger" onclick='return confirm("Вы уверены?")' >Удалить</a>
            </div>
        <?php endif;?>
    </div>

    <?php $form = ActiveForm::end();?>
</div>
