<?php
use MyUtility\MyUtility;
?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div class="clinic-col col-lg-6">
        <div class="row" style="margin: 10px">
            <span class="cashbox-command-button">Смена: </span>
            <a href="#" class="btn btn-success cashbox-command-button" disabled="">Открыть смену</a>
            <a href="index.php?r=cashbox%2Fcashboxpage&request=PrintReport" class="btn btn-success cashbox-command-button">Напечатать отчет за смену</a>
            <a href="#" class="btn btn-danger cashbox-command-button" disabled="">Закрыть смену</a>
        </div>
        <div class="row" style="margin: 10px">
            <span class="cashbox-command-button">Чек: </span>
            <a href="index.php?r=cashbox%2Fcashboxpage&request=CreateCheck" class="btn btn-success cashbox-command-button">Напечатать тестовый чек</a>
            <a href="index.php?r=cashbox%2Fcashboxpage&request=ResetCheck" class="btn btn-warning cashbox-command-button">Сбросить данные печати</a>
        </div>
        <div class="row" style="margin: 10px">
            <span class="cashbox-command-button">Сервисные команды: </span>
            <a href="index.php?r=cashbox%2Fcashboxpage&request=GetDriverInfo" class="btn btn-success cashbox-command-button">Информация о драйвере</a>
            <a href="#" class="btn btn-success cashbox-command-button" disabled="">Регистрация ККТ</a>
        </div>
    </div>

    <div class="clinic-col col-lg-5">
        <div class="row" style="display: flex">
        <?if ($cashboxResponse['code'] != 'none'):?>
            <?if ($cashboxResponse['code'] == 200):?>
                <div class="col-lg-8 cashbox-response cashbox-response-ok">
                    <h4 class="text-center" style="font-weight: bold;"><?='Запрос выполнен: ' . $cashboxResponse['lastRequest']?></h4>
                    <?MyUtility::Dump($cashboxResponse)?>
                </div>
            <?else:?>
                <div class="col-lg-8 cashbox-response cashbox-response-error">
                    <h4 class="text-center" style="font-weight: bold;"><?='Ошибка: ' . $cashboxResponse['lastRequest']?></h4>
                    <?MyUtility::Dump($cashboxResponse)?>
                </div>
            <?endif;?>
        <?endif;?>
        </div>
    </div>

</div>
