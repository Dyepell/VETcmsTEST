<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Kattov;
use yii\widgets\Pjax;
//8010276021571

?>

<script>
    function maxChange(sellItem,kol) {
        //закоментил т.к в сбис учет велся криво
        //$("#inputKol"+sellItem).attr('max',kol);
    }

    let data = <?=$saleModel->goodsBarcodes?>;
   // let barcodes = JSON.parse(data);
    let barcodes = Object.entries(data);
    let itemCounter = <?=count($saleModel->saleItems)?>

    function select_products(saleItem) {
        console.log(this.parent());
        //var block="#"+$("#saleItem" + saleItem +";products").val()+"_block";
        $("#saleItem" + saleItem + ";prihod_block").show();
        $("#inputKol").attr('max',1000);
        $('input:checkbox').click(function() {
            $('input:checkbox').not(this).prop('checked', false);
        });
        $("#saleItem" + saleItem + "prihod_block").hide();
        // $(block).show();
        // console.log(block);
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
    <?php $form = ActiveForm::begin(['options'=>['id'=>'saleForm'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($saleModel, 'employeeId')->dropDownList(
        ArrayHelper::map(\app\models\DoctorForm::find()->orderBy("NAME ASC")->all(), 'ID_DOC', 'NAME'));?>

    <?php $form = ActiveForm::end();?>
    <div class="row">
        <div class="col-lg-6">
            <button href="" id = 'addSaleItem' class="btn btn-info" style="width: 100%;margin-right: 10%; margin-left: 10%">Добавить товар</button>
        </div>
        <div class="col-lg-2">
            <input type="text" style = "margin-left: 40px;" class="form-control" id="newBarcodeInput" placeholder="Штрих-код">
        </div>

    </div>

    <div id = "saleItems" class="row">
        <? foreach ($saleModel->saleItems as $itemKey => $saleItem): ?>
        <div class="clinic-col saleItem" style="min-height: 0px; margin: 15px;" id = "saleItem<?=$itemKey?>">
            <div class="row">
                <div class="col-lg-1">
                    <h4 style="padding: 5px;">Товар <span class="itemCounter"><?=$itemKey + 1?><span></h4>
                </div>
                <div class="col-lg-2">
                    <input type="text" style = " width: 200px; margin-top: 5px;" class="form-control" id="barcodeInput" placeholder="Штрих-код">
                </div>

            </div>

            <select class="form-control goodSelector" id="saleItem<?=$itemKey?>;products">
                <? foreach ($saleModel->goodsReciepts as $key=>$item): ?>
                    <option   value="<?=$key?>" ><?=$item[name]?></option>
                <?endforeach;?>
            </select>

            <? foreach ($saleModel->goodsReciepts as $key=>$item): ?>
                <div id="<?=$key?>_block" class="prihod_block" style="display: none;">
                    <div class="container-fluid row" >
                        <table class="table ">
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
                            <tbody >
                            <? $counter=1; ?>
                            <?foreach ($item[prihods] as $key=>$prihod):?>
                                <? if($prihod[kol]==0): ?>
                                    <tr class="copacity_50 recieptRow">
                                <? else: ?>
                                    <tr class="recieptRow">
                                <? endif; ?>
                                <th scope="row" class=""><?=$counter?></th>
                                <td><?=$key?></td>
                                <td><?=date('d.m.Y', strtotime($prihod[date]))?></td>
                                <td><?=$prihod[prim]?></td>
                                <td class="sellPrice"><?=$prihod[sellPrice]?></td>
                                <td><?=$prihod[kol]?></td>
                                <td>
                                    <? if($prihod[kol]==0): ?>
                                        <input type="checkbox" class = 'recieptRadio' value="<?=$key?>_radio" onchange="maxChange(<?=$itemKey?>, <?=$prihod[kol]?>)" disabled id="<?=$key?>_radio">
                                    <? else: ?>
                                        <input type="checkbox" class = 'recieptRadio' value="<?=$key?>_radio" onchange="maxChange(<?=$itemKey?> ,<?=$prihod[kol]?>)" id="<?=$key?>_radio">
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
                    <input type="number" class="form-control inputKol" id="inputKol<?=$itemKey?>" name="tentacles" min="0" value="1" max="1000">
                </div>
                <div class="col-lg-1">
                    <label for="exampleFormControlSelect1">Скидка</label>
                    <br>
                    <input type="number" value="0" class="form-control discount" id="inputDiscount" name="tentacles" min="0" max="100">
                </div>
                <div class="col" style="text-align: right;margin-top: 30px">
                    <span class = "saleItemSellPrice">0</span>
                    <span class = 'saleItemSum' style="color: rgb(47,169,255);margin-right: 30px; margin-top: 100px;text-align: right; font-size: 200%; font-weight: bold;"></span>
                </div>


            </div>
        </div>
        <? endforeach; ?>

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
            <button id = "sendFormButton"  class="btn btn-success" style="width: 100%; margin-top: 3px;">Сохранить</button>

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
    //clearInterval(barcodeInterval);
});

$('.goodSelector').on("change", function() {
    allReciepts = $(this).closest('.saleItem').find('.prihod_block');
    allReciepts.hide();
    saleItemReciepts = $(this).closest('.saleItem').find('#' + $(this).val() + '_block');
    saleItemReciepts.show();
});

$('.recieptRadio').on('change', function (e){
    goodRadioButtons = $(this).closest('.prihod_block').find('.recieptRadio');
    goodRadioButtons.each(function (){
        console.log($(this).attr('id'));
        if (e.target.id != $(this).attr('id')) {
            $(this).prop("checked", false);
        }
    });
    let sellPrice = $(this).closest('.recieptRow').children('.sellPrice').text();
    let kol = $(this).closest('.saleItem').find('.inputKol').val();
    
    
    $(this).closest('.saleItem').find('.saleItemSellPrice').text(sellPrice);
    $(this).closest('.saleItem').find('.saleItemSum').text(sellPrice * kol);
});


$('inputKol').on('change', function () {
    $(this).closest('.saleItem').find('.saleItemSum').text($(this).closest('.saleItem').find('.saleItemSellPrice') * $(this).val());
});


$('#sendFormButton').on('click', function () {
    saleItemsDivs = $('#saleItems').children('.saleItem');
    let alertText = '';
    let isAlert = false;
    let saleItemsCounter = 1;
    let saleData = [];
    
    saleData['VID_OPL'] = $('#vidOpl').val();
    saleData['ID_DOC'] = $('#saleform_new-employeeid').val();
    console.log(saleData);
    
    //если буду скрывать 1 для автовыбора параметров, то нужно условие
    saleItemsDivs.each(function (){
        selectedGoodId = $(this).children('.goodSelector').val();
        console.log('selectedGood: ' + selectedGoodId);
        
        saleItemReciepts = $(this).find('#' + selectedGoodId + '_block').find('.recieptRadio:checked');
        goodsCount = $(this).find('.inputKol').val();
        saleItemDiscount = $(this).find('.discount').val();
        
        if (saleItemReciepts.length <= 0) {
            alertText += "Не выбрано поступление товара у " + saleItemsCounter + " товара, ";
            isAlert = true;
        }
        
        if (goodsCount <= 0 ){
            alertText += "Не введено количество у " + saleItemsCounter + " товара, ";
            isAlert = true;
        }
        
    });
    
    if (isAlert) {
            alert(alertText);
            return false;
        }
    
});

$('#addSaleItem').on('click', function (){
    temp = $('#saleItem0').clone(true);
    console.log(temp.find('.itemCounter'));
    itemCounter++;
    temp.find('.itemCounter').text(itemCounter);
    temp.find('.prihod_block').hide();
    temp.appendTo('#saleItems');
});

$('#barcodeInput').on('keyup', function (){
    if ($(this).val().trim().length >= 13) {
        console.log('inputBarcode');
        let isCorrect = false;
            barcodes.forEach(e => {
                if (e[1].barcode === $(this).val().trim()){
               goodId = e[1].goodId;
               allReciepts = $(this).closest('.saleItem').find('.prihod_block');
               allReciepts.hide();
               $(this).closest('.saleItem').find('.goodSelector option[value="' + goodId + '"]').attr('selected', 'true');
               saleItemReciepts = $(this).closest('.saleItem').find('#' + goodId + '_block');
               saleItemReciepts.show();
               isCorrect = true;
               return true;
            }
        })
        $(this).val(null);
        if (!isCorrect) {
            alert('Товар не найден');
        }
    } 
});

JS;

$this->registerJs($js);?>



