<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Kattov;
use yii\widgets\Pjax;
function dump($arr){
    echo '<pre>'.print_r($arr, true).'</pre>';
}

?>
<script>


    $(document).ready(function(){
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
    });
    function maxChange(kol) {

        $("#inputKol").attr('max',kol);

    }
    function select_products() {

        var block="#"+$("#products").val()+"_block";
        $("#inputKol").attr('max',1000);
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
        $(".prihod_block").hide();
        $(block).show();
        console.log(block);
    }
    function sendForm() {
        var ID_DOC;
        var PRIHOD_ID;
        var KOL;
        var DISCOUNT_PROCENT;
        var VID_OPL;
        var DATE;
        var goodId;

        ID_DOC=$("#doctors").val();
        $('input:checkbox:checked').each(function(){
            str=($(this).val());
            PRIHOD_ID = str.split('_')[0];
        });
        if(PRIHOD_ID==null){
            alert('Выберите поступление товара');
            return false;
        }
        if($("#inputKol").val()==''){
            alert('Введите количество');
            return false;
        }else(
            KOL=$("#inputKol").val()
        );
        if($("#inputDiscount").val()==''){
            alert('Введите процент скидки');
            return false;
        }else(
            DISCOUNT_PROCENT=$("#inputDiscount").val()
        );
        if($("#inputDate").val()==''){
            alert('Введите дату');
            return false;
        }else(
            DATE=$("#inputDate").val()
        );
        VID_OPL=$("#vidOpl").val();
        goodId = $("#products").val();

        console.log(PRIHOD_ID);
        console.log(KOL);
        console.log(DISCOUNT_PROCENT);
        console.log(VID_OPL);
        console.log(DATE);
        console.log(goodId);

        document.location.href="index.php?r=client/new_sale_form&ID_PRIHOD="+PRIHOD_ID
            +"&ID_DOC="+ID_DOC
            +"&KOL="+KOL
            +"&DISCOUNT_PROCENT="+DISCOUNT_PROCENT
            +"&VID_OPL="+VID_OPL
            +"&DATE="+DATE
            + "&goodId=" + goodId;
    }
</script>
<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <label for="exampleFormControlSelect1">Сотрудник</label>
    <select class="form-control" id="doctors" >
        <? foreach ($doctors as $key=>$doctor): ?>
            <option   value="<?=$doctor->ID_DOC?>" ><?=$doctor->NAME?></option>
        <? endforeach; ?>
    </select>
    <div class="row">
        <div class="clinic-col" style="min-height: 0px; margin: 15px;">
            <label for="exampleFormControlSelect1" style="padding: 5px;">Товар</label>
            <select class="form-control" id="products" onchange="select_products(<?=$item[kol]?>)">
                <? foreach ($salesProducts as $key=>$item): ?>
                    <option   value="<?=$key?>" ><?=$item[name]?></option>
                <?endforeach;?>
            </select>

            <? foreach ($salesProducts as $key=>$item): ?>
            <div id="<?=$key?>_block" class="prihod_block" style="display: none;">
                <div class="container-fluid row" >
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Поступления</th>
                            <th scope="col">Дата поступления</th>
                            <th scope="col">Примечание</th>
                            <th scope="col">Цена продажи</th>
                            <th scope="col">В наличии</th>
                            <th scope="col">Выбор</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? $counter=1; ?>
                        <?foreach ($item[prihods] as $key=>$prihod):?>
                        <? if($prihod[kol]==0): ?>
                                <tr class="copacity_50">
                        <? else: ?>
                                <tr>
                        <? endif; ?>
                            <th scope="row"><?=$counter?></th>
                            <td><?=$key?></td>
                            <td><?=date('d.m.Y', strtotime($prihod[date]))?></td>
                            <td><?=$prihod[prim]?></td>
                            <td class = 'sellPrice'><?=$prihod[sellPrice]?></td>
                            <td><?=$prihod[kol]?></td>
                            <td>
                            <? if($prihod[kol]==0): ?>
                                <input type="checkbox" value="<?=$key?>_radio" onchange="maxChange(<?=$prihod[kol]?>)" disabled id="<?=$key?>_radio">
                            <? else: ?>
                                <input type="checkbox" value="<?=$key?>_radio" onchange="maxChange(<?=$prihod[kol]?>)" id="<?=$key?>_radio">
                            <? endif; ?>
                            </td>
                        </tr>
                        <? $counter++; ?>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <? endforeach; ?>
            <div class="row" style="padding: 10px;">
                <div class="col-lg-1">
                    <label for="exampleFormControlSelect1">Количество</label>
                    <br>
                    <input type="number" class="form-control" id="inputKol" name="tentacles" min="0" max="1000">
                </div>
                <div class="col-lg-1">
                    <label for="exampleFormControlSelect1">Скидка</label>
                    <br>
                    <input type="number" value="0" class="form-control" id="inputDiscount" name="tentacles" min="0" max="100">
                </div>
            </div>
        </div>
        <div class="col">
            <a href="" class="btn btn-info" style="width: 80%; margin-right: 10%; margin-left: 10%">Добавить товар</a>
        </div>

    </div>
    <div class="container-fluid row">
        <div class="col-md-2">
            <label for="exampleFormControlSelect1">Вид оплаты</label>
            <br>
            <select class="form-control" id="vidOpl" onchange="select_products()">
                <option   value="0" >Нал.</option>
                <option   value="1" >Б/Нал.</option>
            </select>

        </div>
        <div class="col-md-2">
            <label for="exampleFormControlSelect1">Дата</label>
            <br>
            <input type="text" class="form-control" value="<?=date('d.m.Y')?>" style="width: 150px;" id="inputDate" >
        </div>
        <div class="col-md-4">
            <br>
            <button onclick="this.disabled=true;sendForm()" class="btn btn-success" style="width: 100%; margin-top: 3px;">Сохранить</button>

        </div>
    </div>



</div>



<?php
$js = <<<JS

function getScannedGood() {
        $.ajax({
            url:  'index.php?r=shop/getscannedgood',
            type: 'POST',
                success: function(response) {
                    console.log(response);
                    document.getElementById('products').value= response;
                    select_products();
                }
            });
        return false;
}

//let barcodeInterval = setInterval(getScannedGood, 500);

$("#products" ).on( "focus", function() {
    clearInterval(barcodeInterval);
});

JS;

$this->registerJs($js);?>



