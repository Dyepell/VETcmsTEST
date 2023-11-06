<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="row container-fluid " style="margin-top: 70px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <span style="font-size: 150%">Биохимический анализ крови: <a href="index.php?r=client/anketa&clientId=<?=$pacient->ID_CL?>"><?=$pacient->KLICHKA?></a></span>
        <br>
        <span><a href="index.php?r=client/analysis&ID_PAC=<?=$pacient->ID_PAC?>" class="btn btn-primary">Исследования</a></span>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'priceForm']]) ?>
        <div style="display: flex;">
            <?= $form->field($blood, 'ID_BIOHIM')->textInput(['readonly'=>'readonly'])?>
            <?= $form->field($blood, 'DATE')->textInput()?>
            <a href="index.php?r=client/printbiohim&ID_BIOHIM=<?=$blood->ID_BIOHIM?>" class="btn btn-success" style="height: 35px;margin-top: 25px;margin-left: 30px;">На печать</a>
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
                <td>Белок общий</td>
                <td>56-78</td>
                <td>59-76</td>
                <td><?= $form->field($blood, 'BELOK')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Билирубин общий</td>
                <td>1,2-7,9</td>
                <td>0,9-10,6</td>
                <td><?= $form->field($blood, 'BILIRUB_OBSH')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>3</th>
                <td>Билирубин прямой</td>
                <td>0,3</td>
                <td>0,3</td>
                <td><?= $form->field($blood, 'BILIRUB_PR')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>4</th>
                <td>Билирубин непрямой</td>
                <td>0,3</td>
                <td>0,3</td>
                <td><?= $form->field($blood, 'BILIRUB_NEPR')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>5</th>
                <td>Ас-АТ</td>
                <td>9-45</td>
                <td>17-45</td>
                <td><?= $form->field($blood, 'AC_AT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>6</th>
                <td>Ал-АТ</td>
                <td>18-70</td>
                <td>20-73</td>
                <td><?= $form->field($blood, 'AL_AT')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>7</th>
                <td>Сахар (глюкоза)</td>
                <td>3,4-6,9</td>
                <td>4,4-5,5</td>
                <td><?= $form->field($blood, 'SUGAR')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>8</th>
                <td>Мочевина</td>
                <td>5,5-11,1</td>
                <td>3,5-9,2</td>
                <td><?= $form->field($blood, 'MOCH')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>9</th>
                <td>Креатинин</td>
                <td>70-165</td>
                <td>26-120</td>
                <td><?= $form->field($blood, 'KREATIN')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>10</th>
                <td>ЛДГ</td>
                <td>55-155</td>
                <td>23-164</td>
                <td><?= $form->field($blood, 'LDG')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>11</th>
                <td>Гамма ГТП:</td>
                <td>1-10</td>
                <td>1-10</td>
                <td><?= $form->field($blood, 'GAMMA_GTP')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>12</th>
                <td>Амилаза:</td>
                <td>20-775</td>
                <td>83-1075</td>
                <td><?= $form->field($blood, 'AMILAZA')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>13</th>
                <td>Калий</td>
                <td>3,8-5,3</td>
                <td>3,8-5,6</td>
                <td><?= $form->field($blood, 'KALIY')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>14</th>
                <td>Кальций:</td>
                <td>2,0-2,7</td>
                <td>2,3-3,3</td>
                <td><?= $form->field($blood, 'KALCIY')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>15</th>
                <td>Щелочная фосфатаза:</td>
                <td>10-50</td>
                <td>0,85-107</td>
                <td><?= $form->field($blood, 'SHELOCH')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>16</th>
                <td>Фосфор:</td>
                <td>0,71-1,9</td>
                <td>0,97-1,45</td>
                <td><?= $form->field($blood, 'FOSFOR')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>
            <tr>
                <th>17</th>
                <td>Холестерин</td>
                <td>1,8-4,2</td>
                <td>2,6-7,0</td>
                <td><?= $form->field($blood, 'HOL')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>

            <tr>
                <th>18</th>
                <td>Альбумин</td>
                <td>25-37</td>
                <td>22-39</td>
                <td><?= $form->field($blood, 'ALB')->textInput(['autocomplete'=>'off'])->label(false)?></td>
            </tr>



            </tbody>
        </table>




        <div class="row">

            <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

            <?php if ($_GET['ID_BIOHIM']!=NULL):?>
                <div class="col-md-10" style="text-align: right">
                    <a href="index.php?r=client/biohimdelete&ID_BIOHIM=<?=$blood->ID_BIOHIM?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
                </div>
            <?php endif;?>
        </div>

        <?php $form = ActiveForm::end();?>
    </div>

