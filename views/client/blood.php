<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="row container-fluid " style="margin-top: 70px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <span style="font-size: 150%">Анализ крови: <a href="index.php?r=client/anketa&clientId=<?=$pacient->ID_CL?>"><?=$pacient->KLICHKA?></a></span>
        <br>
        <span><a href="index.php?r=client/analysis&ID_PAC=<?=$pacient->ID_PAC?>" class="btn btn-primary">Исследования</a></span>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'priceForm']]) ?>
        <div style="display: flex;">
        <?= $form->field($blood, 'ID_BLOOD')->textInput(['readonly'=>'readonly'])?>
        <?= $form->field($blood, 'DATE')->textInput()?>
            <a href="index.php?r=client/printblood&ID_BLOOD=<?=$blood->ID_BLOOD?>" class="btn btn-success" style="height: 35px;margin-top: 25px;margin-left: 30px;">На печать</a>
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
                <td>Эритроциты</td>
                <td>5,0-10,0 млн/мкл</td>
                <td>5,5-8,5 млн/мкл</td>
                <td><?= $form->field($blood, 'ERIT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Гемоглобин</td>
                <td>80-150 г/л</td>
                <td>120-180 г/л</td>
                <td><?= $form->field($blood, 'GEMOG')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>3</th>
                <td>Цветовой показатель</td>
                <td>24-45%</td>
                <td>37-55%</td>
                <td><?= $form->field($blood, 'COLOR')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>4</th>
                <td>Лейкоциты</td>
                <td>5,5-19,5 тыс/мкл</td>
                <td>6-17,0 тыс/мкл</td>
                <td><?= $form->field($blood, 'LEIC')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>5</th>
                <td>Базофилы</td>
                <td>0-1%</td>
                <td>0-1%</td>
                <td><?= $form->field($blood, 'BAZ')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>6</th>
                <td>Эозинофилы</td>
                <td>2-12%</td>
                <td>2-10%</td>
                <td><?= $form->field($blood, 'EOZ')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>7</th>
                <td>Нейтрофилы миелоциты</td>
                <td>0</td>
                <td>0</td>
                <td><?= $form->field($blood, 'MIEL')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>8</th>
                <td>Нейтрофилы юные</td>
                <td>0</td>
                <td>0</td>
                <td><?= $form->field($blood, 'NUN')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>9</th>
                <td>Нейтрофилы палочкоядерные</td>
                <td>3-6%</td>
                <td>1-3%</td>
                <td><?= $form->field($blood, 'NPAL')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>10</th>
                <td>Нейтрофилы сегментоядерные:</td>
                <td>40-45%</td>
                <td>43-71%</td>
                <td><?= $form->field($blood, 'NSEG')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>11</th>
                <td>Лимфоциты:</td>
                <td>20-55%</td>
                <td>12-30%</td>
                <td><?= $form->field($blood, 'LIMF')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>12</th>
                <td>Моноциты:</td>
                <td>1-4%</td>
                <td>3-10%</td>
                <td><?= $form->field($blood, 'MONO')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>13</th>
                <td>Плазм. клетки:</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'PLAZM')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>14</th>
                <td>СОЭ:</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'SOE')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>15</th>
                <td>Особые отметки:</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'OSOTM')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>

                <th>16</th>
                <td>Гематокрит:</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'GEMAT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>17</th>
                <td>Тромбоциты:</td>
                <td>160-630</td>
                <td>160-550</td>
                <td><?= $form->field($blood, 'TROMBOCIT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>18</th>
                <td>Тромбокрит:</td>
                <td></td>
                <td></td>
                <td><?= $form->field($blood, 'TROMBOKRIT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>

            </tbody>
        </table>




        <div class="row">

        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

        <?php if ($_GET['ID_BLOOD']!=NULL):?>
            <div class="col-md-10" style="text-align: right">
                <a href="index.php?r=client/blooddelete&ID_BLOOD=<?=$blood->ID_BLOOD?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
            </div>
        <?php endif;?>
        </div>

    <?php $form = ActiveForm::end();?>
    </div>

