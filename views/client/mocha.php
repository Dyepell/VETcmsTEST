<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="row container-fluid " style="margin-top: 70px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <span style="font-size: 150%">Общий анализ мочи: <a href="index.php?r=client/anketa&clientId=<?=$pacient->ID_CL?>"><?=$pacient->KLICHKA?></a></span>
        <br>
        <span><a href="index.php?r=client/analysis&ID_PAC=<?=$pacient->ID_PAC?>" class="btn btn-primary">Исследования</a></span>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'priceForm']]) ?>
        <div style="display: flex;">
            <?= $form->field($blood, 'ID_MOCHA')->textInput(['readonly'=>'readonly'])?>
            <?= $form->field($blood, 'DATE')->textInput()?>
            <a href="index.php?r=client/printmocha&ID_MOCHA=<?=$blood->ID_MOCHA?>" class="btn btn-success" style="height: 35px;margin-top: 25px;margin-left: 30px;">На печать</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Показатель</th>
                <th scope="col">Норма для кошек</th>
                <th scope="col">Норма для собак</th>
                <th scope="col"><?=$pacient->KLICHKA?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Количество, цвет и др.</td>
                <td>св. желт. до янт. желт; прозрач</td>
                <td>св. желт. до янт. желт.; прозрач</td>
                <td><?= $form->field($blood, 'KOL')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Белок</td>
                <td>отр.</td>
                <td>отр.</td>
                <td><?= $form->field($blood, 'BELOK')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>3</th>
                <td>Сахар</td>
                <td>отр.</td>
                <td>отр.</td>
                <td><?= $form->field($blood, 'SUGAR')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>4</th>
                <td>Ацетон</td>
                <td>отр.</td>
                <td>отр.</td>
                <td><?= $form->field($blood, 'ACETONE')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>5</th>
                <td>Уробин</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'UROB')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>6</th>
                <td>Реакция</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'REACT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>7</th>
                <td>Лейкоциты</td>
                <td>0-5</td>
                <td>0-5</td>
                <td><?= $form->field($blood, 'LEIC')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>8</th>
                <td>Эритроциты</td>
                <td>0-3</td>
                <td>0-3</td>
                <td><?= $form->field($blood, 'ERIT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>9</th>
                <td>Цилиндроиды гиалиновые</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'CIL_GAL')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>10</th>
                <td>Цилиндроиды зернистые</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'CIL_ZERN')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>11</th>
                <td>Цилиндроиды восковидные</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'CIL_VOSK')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>12</th>
                <td>Цилиндроиды</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'CILINDROID')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>13</th>
                <td>Эпителий</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'EPIT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>14</th>
                <td>Эпителий почечный</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'EPIT_POCH')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>15</th>
                <td>Эпителий плоский</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'EPIT_PLOSK')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>16</th>
                <td>Слизь</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'SLIZ')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>17</th>
                <td>Соли</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'SULT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>18</th>
                <td>Бактерии</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'BAKT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>



            </tbody>
        </table>




        <div class="row">

            <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

            <?php if ($_GET['ID_MOCHA']!=NULL):?>
                <div class="col-md-10" style="text-align: right">
                    <a href="index.php?r=client/mochadelete&ID_MOCHA=<?=$blood->ID_MOCHA?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
                </div>
            <?php endif;?>
        </div>

        <?php $form = ActiveForm::end();?>
    </div>

