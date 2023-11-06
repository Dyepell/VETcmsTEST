<?php


namespace app\controllers;
use app\models\Client;
use app\models\Doctor;
use app\models\Facility;
use app\models\Kattov;
use app\models\Oplata;
use app\models\OplataForm;
use app\models\Pacient;
use app\models\Price;
use app\models\Prihod_tovara;
use app\models\Sale;
use app\models\sl_vakc;
use app\models\Spdoc;
use app\models\Vid;
use app\models\Vizit;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii;
use yii\helpers\StringHelper;
use app\models\Expense_catalog;


class Doc {
    public $name;
    public $pacients=[];
    public $summ;
    public $chek;
}
class Dolg{
    public $dolgDate;
    public $pacient;
    public $fio;
    public $summ;

}
class NewPacient{
    public  $fio;
    public $name;
    public $vid;
    public $date;
}
class Predusl{
    public $firstdate;
    public $seconddate;
    public $usluga;
    public $fio;
    public $pacient;
    public $numbers;
}
class DoctorPay{
    public $id;
    public $name;
    public $thProcent;
    public $suProcent;
    public $uzProcent;
    public $vakProcent;
    public $medProcent;
    public $degProcent;
    public $anProcent;
    public $kormProcent;

    public $thSumm;
    public $suSumm;
    public $uzSumm;
    public $vakSumm;
    public $medSumm;
    public $degSumm;
    public $anSumm;
    public $kormSumm;
}


class ReportsController extends AppController
{
    public $layout='basic';

    public function beforeAction($action)
    {
        if ($action->id=='index'){
            $this->enableCsrfValidation=false;
        }
        return parent::beforeAction($action);
    }

    public function actionOtchet_uslugi(){



        $date=date("d.m.Y");
        return $this->render('otchet_uslugi', compact('date'));
    }

    public function actionOtchet_uslugi_form(){

        Yii::setAlias('@reports', Yii::$app->basePath.'/reports');
        $firstdate= ($_GET['FIRST_DATE_S']);
        $secondtdate= ($_GET['SECOND_DATE_S']);

        $firstdate =date("Y-m-d", strtotime($firstdate));
        $secondtdate =date("Y-m-d", strtotime($secondtdate));

        if($_GET["vid"]==0) {
            //-------------------------Отчет по пациентам--------------------------------------
            //Получение списка работающих специалистов
            $doctors=Doctor::find()->where(['STATUS_R'=>1])
                ->select(["ID_DOC", "NAME"])
                ->all();
            //Получение списка услуг за указанный период
            $facilities=Facility::find()
                ->where(['between', 'facility.DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->joinWith("pacient")
                ->joinWith("client")
                ->joinWith("price")
                ->joinWith("doctor")
                ->orderBy([
                    'client.FAM' => SORT_ASC,
                    'client.NAME' => SORT_ASC,
                    'client.OTCH' => SORT_ASC,
                    'pacient.KLICHKA'=>SORT_ASC,
                ])
                ->all();
            //получение оплат за период
            $clientsPays=Oplata::find()
                ->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(["oplata.IsDolg"=>NULL])
                ->all();
            $clientsDolg=Vizit::find()
                ->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(['>', 'DOLG', '0'])
                ->all();
            //долг

            $clientsDolgArray=[];
            foreach ($clientsDolg as $dolg){
                $clientsDolgArray[$dolg->ID_CL]['dolg']+=$dolg->DOLG;
            }




            $clientsPaysArray=[];
            foreach ($clientsPays as $pay){
                    if($pay->VID_OPL==0) {
                        $clientsPaysArray[$pay->ID_CL]['nal']+=$pay->SUMM;
                    }else{
                        $clientsPaysArray[$pay->ID_CL]['bnal']+=$pay->SUMM;
                    }
            }

            //Создание книги
            $spreadsheet = new Spreadsheet();
            $sheet=$spreadsheet->getActiveSheet();
            //Массив полей отчета
            $titles = array(
                array(
                    'name' => 'Дата',
                    'cell' => 'A',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Клиент',
                    'cell' => 'B',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Пациент',
                    'cell' => 'C',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Услуга',
                    'cell' => 'D',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Кол-во',
                    'cell' => 'E',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Цена',
                    'cell' => 'F',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Скидка, %',
                    'cell' => 'G',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Нал.',
                    'cell' => 'H',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Бнал.',
                    'cell' => 'I',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Выручка',
                    'cell' => 'J',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Долг',
                    'cell' => 'K',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Специалист',
                    'cell' => 'L',
                    "width"=>"37",
                )

            );

            //шапка отчета
            $sheet->setCellValue('A1', 'ЗооДоктор');
            $sheet->setCellValue('D1', date("d.m.Y"));

            $sheet->setCellValue('A2', 'Отчет об услугах по пациентам');
            $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
            $sheet->mergeCells('A2:F2');

            $titelsRow=4;
            foreach ($titles as $title){
                $sheet->setCellValue($title['cell'].$titelsRow,$title['name']);
                $sheet->getColumnDimension($title['cell'])->setWidth($title['width']);
//                $sheet->getColumnDimension($title['cell'])->setAutoSize(true);
            }

            $activeRow=5;
            $clients=[];
            $lastClient="start";
            $clientKol=0;
            $clientSumm=0;


            $totalNal=0;
            $totalBnal=0;
            $totalVir=0;
            $totalDolg=0;


            foreach ($facilities as $facility){

                //вывод итоговой строки клиента
                   if($facility->ID_CL!=$lastClient->ID_CL&&$lastClient!="start"){
                       $sheet->mergeCells("A$activeRow:D$activeRow");
                       $sheet->setCellValue("A$activeRow", $lastClient->FAM
                           . ' ' . mb_substr($lastClient->NAME, 0, 1) . '. ' . mb_substr($lastClient->OTCH, 0, 1) . '.');
                       $sheet->getStyle("A$activeRow")->getAlignment()->setHorizontal("right");

                       //подсчет итого

                       $sheet->setCellValue("H$activeRow", $clientsPaysArray[$lastClient->ID_CL]['nal']);
                       $totalNal=$totalNal+$clientsPaysArray[$lastClient->ID_CL]['nal'];
//                        $this->debug($clientsPaysArray);
                       $sheet->setCellValue("I$activeRow", $clientsPaysArray[$lastClient->ID_CL]['bnal']);
                       $totalBnal=$totalBnal+$clientsPaysArray[$lastClient->ID_CL]['bnal'];

                       $vir=$clientsPaysArray[$lastClient->ID_CL]['bnal'] + $clientsPaysArray[$lastClient->ID_CL]["nal"];
                       $sheet->setCellValue("J$activeRow", $vir);
                       $totalVir=$totalVir+$vir;

//                       $sheet->setCellValue("K$activeRow", $clientSumm-$vir);
//                       $totalDolg=$totalDolg+($clientSumm-$vir);
                       $sheet->setCellValue("K$activeRow", $clientsDolgArray[$lastClient->ID_CL]['dolg']);
                       $totalDolg=$totalDolg+($clientsDolgArray[$lastClient->ID_CL]['dolg']);

                       $sheet->getStyle("A$activeRow:L$activeRow")->getFont()->setBold(1);

                       $clientSumm=0;
                       $activeRow++;
                   }
                    $sheet->setCellValue("A$activeRow", date("d.m.Y", strtotime($facility->DATA)));
                    $sheet->setCellValue("B$activeRow", $facility->client->FAM
                        . ' ' . mb_substr($facility->client->NAME, 0, 1) . '. ' . mb_substr($facility->client->OTCH, 0, 1) . '.');
                    $sheet->setCellValue("C$activeRow", $facility->pacient->KLICHKA);
                    $sheet->setCellValue("D$activeRow", $facility->price->NAME);
                    $sheet->setCellValue("E$activeRow", $facility->KOL);

                    $sheet->setCellValue("F$activeRow", $facility->price->PRICE);
                    $sheet->setCellValue("G$activeRow", $facility->DISCOUNT_PROCENT);
                    $clientSumm=$clientSumm+$facility->SUMMA;
                    $sheet->setCellValue("L$activeRow", $facility->doctor->NAME);


                $lastClient=$facility->client;
                $activeRow++;

            }
            //вывод итоговой строки последнего клиента
            $sheet->mergeCells("A$activeRow:D$activeRow");
            $sheet->setCellValue("A$activeRow", $lastClient->FAM
                . ' ' . mb_substr($lastClient->NAME, 0, 1) . '. ' . mb_substr($lastClient->OTCH, 0, 1) . '.');
            $sheet->getStyle("A$activeRow")->getAlignment()->setHorizontal("right");

            //подсчет итого

            $sheet->setCellValue("H$activeRow", $clientsPaysArray[$lastClient->ID_CL]['nal']);
            $totalNal=$totalNal+$clientsPaysArray[$lastClient->ID_CL]['nal'];

            $sheet->setCellValue("I$activeRow", $clientsPaysArray[$lastClient->ID_CL]['bnal']);
            $totalBnal=$totalBnal+$clientsPaysArray[$lastClient->ID_CL]['bnal'];

            $vir=$clientsPaysArray[$lastClient->ID_CL]['bnal'] + $clientsPaysArray[$lastClient->ID_CL]["nal"];
            $sheet->setCellValue("J$activeRow", $vir);
            $totalVir=$totalVir+$vir;

            $sheet->setCellValue("K$activeRow", $clientSumm-$vir);
            $totalDolg=$totalDolg+($clientSumm-$vir);

            $sheet->getStyle("A$activeRow:L$activeRow")->getFont()->setBold(1);
            $sheet->getStyle("A4:L$activeRow")
                ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $clientSumm=0;
            $activeRow++;

            //вывод итоговой строки отчета

            $sheet->setCellValue("D$activeRow","Итого:");


            $sheet->setCellValue("H$activeRow", $totalNal);
            $sheet->setCellValue("I$activeRow", $totalBnal);
            $sheet->setCellValue("J$activeRow", $totalVir);
            $sheet->setCellValue("K$activeRow", $totalDolg);
            $sheet->getStyle("A$activeRow:L$activeRow")->getFont()->setBold(1);
            $sheet->getStyle("D$activeRow:L$activeRow")
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

            //Формирование файла и выдача его пользователю
            $filename='/_Отчет об услугах по пациентам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save(Yii::getAlias('@reports').$filename);
            $path = \Yii::getAlias('@reports') ;

            $file = $path.$filename;


            if (file_exists($file)) {
                \Yii::$app->response->sendFile($file);
            }else {
                throw new \Exception('Файл не найден');
            }


        }











        if($_GET["vid"]==1){

            //-------------------------Отчет по специалистам--------------------------------------
            $doctor=Doctor::find()->where(['STATUS_R'=>1])->all();

            $spreadsheet = new Spreadsheet();
            $titles = array(
                array(
                    'name' => 'Дата',
                    'cell' => 'A',
                ),
                array(
                    'name' => 'Фио клиента',
                    'cell' => 'B',
                ),
                array(
                    'name' => 'Пациент',
                    'cell' => 'C',
                ),
                array(
                    'name' => 'Процедура',
                    'cell' => 'D',
                ),
                array(
                    'name' => 'Цена',
                    'cell' => 'E',
                ),
                array(
                    'name' => 'Кол-во',
                    'cell' => 'F',
                ),
                array(
                    'name' => 'Сумма',
                    'cell' => 'G',
                ),

            );

            for($i=0;$i < count($doctor);$i++){





                $page = $spreadsheet->setActiveSheetIndex($i);

                $page->setTitle($doctor[$i]->NAME);



                $facility = Facility::find()->where(['between', 'DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->andWhere(['ID_DOC' => $doctor[$i]->ID_DOC])->all();



                $spreadsheet->getActiveSheet()->setCellValue('A1', 'ЗооДоктор');
                $spreadsheet->getActiveSheet()->setCellValue('D1', date("d.m.Y"));

                $spreadsheet->getActiveSheet()->setCellValue('A2', 'Отчет об услугах по специалисту: ' . $doctor[$i]->NAME);
                $spreadsheet->getActiveSheet()->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
                $spreadsheet->getActiveSheet()->mergeCells('A2:F2');
                for ($j = 0; $j < count($titles); $j++) {
                    $string = $titles[$j]['name'];
                    $cellLatter = $titles[$j]['cell'] . 4;
                    $spreadsheet->getActiveSheet()->setCellValue($cellLatter, $string);
                }

                $totalSumm = 0;
                $count = count($facility);
                for ($y = 0; $y< $count; $y++) {

                    $pacient = Pacient::findOne(['ID_PAC' => $facility[$y]->ID_PAC]);

                    $client = Client::findOne(['ID_CL' => $pacient->ID_CL]);
                    $procedure = Price::findOne(['ID_PR' => $facility[$y]->ID_PR]);


                    $c = $y + 5;
                    $cellA = 'A' . $c;
                    $cellB = 'B' . $c;
                    $cellC = 'C' . $c;
                    $cellD = 'D' . $c;
                    $cellE = 'E' . $c;
                    $cellF = 'F' . $c;
                    $cellG = 'G' . $c;


                    $n = StringHelper::truncate($client->NAME, 1, '');
                    $o = StringHelper::truncate($client->OTCH, 1, '');

                    $stringA = $facility[$y]->DATA;
                    $stringA = date('d.m.Y', strtotime($stringA));

                    $stringB = $client->FAM . ' ' . $n . '. ' . $o . '.';
                    $stringC = $pacient->KLICHKA;

                    $stringD = $procedure->NAME;

                    $stringE = $procedure->PRICE;
                    $stringF = $facility[$y]->KOL;
                    $stringG = $stringE * $stringF;

                    $spreadsheet->getActiveSheet()->setCellValue($cellA, $stringA);
                    $spreadsheet->getActiveSheet()->setCellValue($cellB, $stringB);
                    $spreadsheet->getActiveSheet()->setCellValue($cellC, $stringC);

                    $spreadsheet->getActiveSheet()->setCellValue($cellD, $stringD);
                    $spreadsheet->getActiveSheet()->setCellValue($cellE, $stringE);
                    $spreadsheet->getActiveSheet()->setCellValue($cellF, $stringF);

                    $spreadsheet->getActiveSheet()->setCellValue($cellG, $stringG);
                    $totalSumm = $totalSumm + $stringG;

                    $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
                    $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);


                }
                $eCount = $count + 5;
                $e = 'E' . $eCount;
                $f = 'F' . $eCount;
                $a = 'A' . $eCount;
                $g = 'G' . $eCount;


                $spreadsheet->getActiveSheet()->mergeCells($a . ':' . $e);

                $spreadsheet->getActiveSheet()->getStyle('A4:' . $g)
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(19);
                $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(12);
                $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(19);
                $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(7);
                $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(7);
                $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(9);


                $spreadsheet->getActiveSheet()->setCellValue($f, 'Итого:');
                $spreadsheet->getActiveSheet()->setCellValue($g, $totalSumm);

                $spreadsheet->createSheet();



            }


            $filename='/_Отчет об услугах по специалистам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save(Yii::getAlias('@reports').$filename);
            $path = \Yii::getAlias('@reports') ;

            $file = $path.$filename;


            if (file_exists($file)) {
                \Yii::$app->response->sendFile($file);
            }else {
                throw new \Exception('Файл не найден');
            }
        }

        if($_GET["vid"]==2){
            //-----------------------------------------Отчет по пациентам сокращенный ----------------------------------------------------------

            $spreadsheet= new Spreadsheet();
            $sheet=$spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ЗооДоктор');
            $sheet->setCellValue('D1', date("d.m.Y"));


            $sheet->setCellValue('A2', 'Отчет об услугах по пациентам (сокращенный)');


            $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
            $sheet->mergeCells('A2:F2');

            $titles = array(
                array(
                    'name' => 'Клиент',
                    'cell' => 'A',
                    'width' =>'19',
                ),
                array(
                    'name' => 'Пациент',
                    'cell' => 'B',
                    'width' =>'19',
                ),
                array(
                    'name' => 'Сумма визитов',
                    'cell' => 'C',
                    'width' =>'13',
                ),
                array(
                    'name' => 'Наличные',
                    'cell' => 'D',
                    'width' =>'13',
                ),
                array(
                    'name' => 'Б/нал',
                    'cell' => 'E',
                    'width' =>'13',
                ),
                array(
                    'name' => 'Долг',
                    'cell' => 'F',
                    'width' =>'13',
                ),


            );

            for ($j = 0; $j < count($titles); $j++) {
                $string = $titles[$j]['name'];
                $cellLatter = $titles[$j]['cell'] . 4;
                $sheet->setCellValue($cellLatter, $string);
                $sheet->getColumnDimension($titles[$j]['cell'])->setWidth($titles[$j]['width']);
            }
            $totalSumm=0;
            $totaltDolg=0;
            $totaltNal=0;
            $totaltBnal=0;
            $activeRow=4;

            $clients[]=0;
            $clientsCount=0;
            $facilities=Facility::find()->where(['between', 'DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->joinWith("client")
                ->joinWith("pacient")
                ->orderBy(['client.FAM' => SORT_ASC])
                ->all();

//            for($i=0; $i< count($facility); $i++){
////
////
////                for($j=0;$j<count($facility);$j++){
////                    if(!(in_array($facility[$j]->ID_CL, $clients))){
////                        $clients[$clientsCount]=$facility[$j]->ID_CL;
////                        $clientsCount++;
////
////                    }
////                }
////
////            }
///

            $clientsPays=Oplata::find()
                ->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(["oplata.IsDolg"=>NULL])
                ->all();
            $clientsDolg=Vizit::find()
                ->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(['>', 'DOLG', '0'])
                ->all();
            //долг



            $resultArray=[];
            foreach ($facilities as $item){
                $n = StringHelper::truncate($item->client->NAME, 1, '');
                $o = StringHelper::truncate($item->client->OTCH, 1, '');


                $clientFIO = $item->client->FAM . ' ' . $n . '. ' . $o . '.';
                $resultArray[$item->client->ID_CL]=[
                    'FIO'=>$clientFIO,
                    'summ'=>0,
                    'nal'=>0,
                    'bNal'=>0,
                    'dolg'=>0,
                    'pacients'=>[],
                ];
            }
            foreach ($facilities as $item){

                $resultArray[$item->client->ID_CL]['pacients'][$item->pacient->ID_PAC]['klichka']=$item->pacient->KLICHKA;
                $resultArray[$item->client->ID_CL]['pacients'][$item->pacient->ID_PAC]['summ']+=$item->SUMMA;
                $resultArray[$item->client->ID_CL]['summ']+=$item->SUMMA;
                $totalSumm+=$item->SUMMA;
            }

            foreach ($clientsDolg as $dolg){
                $resultArray[$dolg->ID_CL]['dolg']+=$dolg->DOLG;
                $totalDolg+=$dolg->DOLG;
            }


            foreach ($clientsPays as $pay){
                if($pay->VID_OPL==0) {
                    $resultArray[$pay->ID_CL]['nal']+=$pay->SUMM;
                    $totalNal+=$pay->SUMM;
                }else{
                    $resultArray[$pay->ID_CL]['bNal']+=$pay->SUMM;
                    $totalBnal+=$pay->SUMM;
                }
            }


            $activeRow=4;

            foreach ($resultArray as $item){
                if($item[pacients]!=NULL){
                    foreach ($item[pacients] as $pacient){
                        $activeRow++;
                        $sheet->setCellValue("B$activeRow", $pacient[klichka]);
                        $sheet->setCellValue("C$activeRow", $pacient[summ]);
                    }
                }
                $activeRow++;
                $sheet->setCellValue("A$activeRow", $item[FIO]);
                $sheet->setCellValue("C$activeRow", $item[summ]);
                $sheet->setCellValue("D$activeRow", $item[nal]);
                $sheet->setCellValue("E$activeRow", $item[bNal]);
                $sheet->setCellValue("F$activeRow", $item[dolg]);
                $sheet->getStyle("A$activeRow:F$activeRow")->getFont()->setBold(1);

            }
            $activeRow++;
            $sheet->setCellValue("C$activeRow", $totalSumm);
            $sheet->setCellValue("D$activeRow", $totalNal);
            $sheet->setCellValue("E$activeRow", $totalBnal);
            $sheet->setCellValue("F$activeRow", $totalDolg);
            $sheet->getStyle('A4:' . "F$activeRow")
                ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->mergeCells("A$activeRow:B$activeRow");



            $filename='/_Отчет об услугах по пациентам (сокращенный) c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';


            $writer = new Xlsx($spreadsheet);
            $writer->save(Yii::getAlias('@reports').$filename);
            $path = \Yii::getAlias('@reports') ;

            $file = $path.$filename;
            if (file_exists($file)) {
                \Yii::$app->response->sendFile($file);
            }else {
                throw new \Exception('Файл не найден');
            }

        }



        $date=date('d.m.Y');
        return $this->render('otchet_uslugi', compact('date'));
    }
    public function actionReport_sale(){
        $date=date('d.m.Y');
        return $this->render('report_sale', compact('date'));
    }



    //----------------------------------------------Отчет по продажам--------------------------------------------------
    public function actionReport_sale_form(){
        Yii::setAlias('@reports', Yii::$app->basePath.'/reports');
        $firstdate= ($_GET['FIRST_DATE']);
        $secondtdate= ($_GET['SECOND_DATE']);


        $firstdate =date("Y-m-d", strtotime($firstdate));
        $secondtdate =date("Y-m-d", strtotime($secondtdate));

        $sales=Sale::find()
            ->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();

        $spreadsheet = new Spreadsheet();
        $titles = array(
            array(
                'name' => '№',
                'cell' => 'A',
            ),
            array(
                'name' => 'Наименование',
                'cell' => 'B',
            ),
            array(
                'name' => 'Цена',
                'cell' => 'C',
            ),
            array(
                'name' => 'Кол-во',
                'cell' => 'D',
            ),
            array(
                'name' => 'Скидка, %',
                'cell' => 'E',
            ),
            array(
                'name' => 'Нал.',
                'cell' => 'F',
            ),
            array(
                'name' => 'Б/бнал.',
                'cell' => 'G',
            ),
            array(
                'name' => 'Сумма',
                'cell' => 'H',
            ),

        );

        $specs[]=0;
        $specsCount=0;
        for($i=0; $i<count($sales); $i++){
            if(!in_array($sales[$i]->SOTRUDNIK,$specs)){
                $specs[$specsCount]=$sales[$i]->SOTRUDNIK;
                $specsCount++;


            }
        }
        for($i=0;$i<count($specs);$i++){
            $spreadsheet->setActiveSheetIndex($i);
            $sheet=$spreadsheet->getActiveSheet();
            $doctor=Doctor::findOne(['ID_DOC'=>$specs[$i]]);
            $sheet->setTitle($doctor->NAME);
            $activeRow=5;
            $saleNum=0;
            $totalNal=0;
            $totalBnal=0;
            $totalSumm=0;
            for ($j = 0; $j < count($titles); $j++) {

                $string = $titles[$j]['name'];
                $cellLatter = $titles[$j]['cell'] . 4;
                $sheet->setCellValue($cellLatter, $string);
            }
            $sheet->setCellValue('A1', 'ЗооДоктор');
            $sheet->setCellValue('D1', date("d.m.Y"));
            $sheet->setCellValue('A2', 'Отчет по продажам ('.$doctor->NAME.')');
            $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
            $sheet->mergeCells('A2:F2');

            $specSales=Sale::find()
                ->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(['SOTRUDNIK'=>$specs[$i]])->all();
            for($j=0;$j<count($specSales);$j++){
                $saleNum=$saleNum+1;
                $cellA='A'.$activeRow;
                $cellB='B'.$activeRow;
                $cellC='C'.$activeRow;
                $cellD='D'.$activeRow;
                $cellE='E'.$activeRow;
                $cellF='F'.$activeRow;
                $cellG='G'.$activeRow;
                $cellH='H'.$activeRow;
                $tovar=Prihod_tovara::find()->where(['ID_PRIHOD'=>$specSales[$j]->ID_PRIHOD])->joinWith('tovar')->all();
//                $tovar=Kattov::findOne(['ID_TOV'=>$specSales[$j]->ID_TOV]);
                $sheet->setCellValue($cellA,$saleNum);
                $sheet->setCellValue($cellB,$tovar[0]->tovar->NAME);
                $sheet->setCellValue($cellC,$tovar[0]->SELL_PRICE);
                $sheet->setCellValue($cellD,$specSales[$j]->KOL);
                $sheet->setCellValue($cellE,$specSales[$j]->SKIDKA);

                if($specSales[$j]->VID_OPL==0){
                    $sheet->setCellValue($cellF,$specSales[$j]->SUMM);
                    $totalNal=$totalNal+$specSales[$j]->SUMM;
                }else{
                    $sheet->setCellValue($cellG,$specSales[$j]->SUMM);
                    $totalBnal=$totalBnal+$specSales[$j]->SUMM;
                }
                $sheet->setCellValue($cellH,$specSales[$j]->SUMM);
                $totalSumm=$totalSumm+$specSales[$j]->SUMM;
                $activeRow++;
            }
            $cellA='A'.$activeRow;
            $cellD='D'.$activeRow;

            $cellE='E'.$activeRow;
            $cellF='F'.$activeRow;
            $cellG='G'.$activeRow;
            $cellH='H'.$activeRow;

            $sheet->setCellValue($cellF,$totalNal);
            $sheet->setCellValue($cellG,$totalBnal);
            $sheet->setCellValue($cellH,$totalSumm);
            $sheet->getStyle('A4:' . $cellH)
                ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->mergeCells($cellA.':'.$cellE);
            $sheet->getColumnDimension('B')->setWidth(25);
            $spreadsheet->createSheet();

        }


        $filename='/_Отчет по продажам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';


        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports') ;

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }

        return $this->render('report_sale', compact('date'));
    }

    public function actionReport_spec(){
        $date=date('d.m.Y');




        return $this->render('report_spec', compact('date'));
    }
    public function actionReport_spec_form(){
        $date=date('d.m.Y');

        Yii::setAlias('@reports', Yii::$app->basePath.'/reports');
        $firstdate= ($_GET['FIRST_DATE']);
        $secondtdate= ($_GET['SECOND_DATE']);


        $firstdate =date("Y-m-d", strtotime($firstdate));
        $secondtdate =date("Y-m-d", strtotime($secondtdate));
        $spreadsheet = new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));
        $sheet->setCellValue('A2', 'Отчет по специалистам');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:F2');
        $titles = array(
            array(
                'name' => 'Специалист',
                'cell' => 'A',
            ),
            array(
                'name' => 'Кол-во пациентов',
                'cell' => 'B',
            ),
            array(
                'name' => 'Выручка',
                'cell' => 'C',
            ),
            array(
                'name' => 'Ср. чек',
                'cell' => 'D',
            ),


        );

        $docs=[];
        $facility=Facility::find()->where(['between', 'DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();
        $totalSumm=0;
        for($i=0;$i<count($facility); $i++){
            $idDoc=$facility[$i]->ID_DOC;
            if(!array_key_exists($facility[$i]->ID_DOC, $docs)){
                $docs[$idDoc]=new Doc;
                $doctor=Doctor::findOne(['ID_DOC'=>$idDoc]);
                $docs[$idDoc]->name=$doctor->NAME;
            }
            if(array_key_exists($idDoc, $docs)){
                $docs[$idDoc]->summ=$docs[$idDoc]->summ+$facility[$i]->SUMMA;
                $totalSumm=$totalSumm+$facility[$i]->SUMMA;
                    if(!in_array($facility[$i]->ID_PAC,$docs[$idDoc]->pacients)){
                        array_push($docs[$idDoc]->pacients, $facility[$i]->ID_PAC);
                    }

            }
        }
        for ($j = 0; $j < count($titles); $j++) {

            $string = $titles[$j]['name'];
            $cellLatter = $titles[$j]['cell'] . 4;
            $sheet->setCellValue($cellLatter, $string);
        }
        $activeRow=5;
        foreach ($docs as $d){
            $d->chek=round($d->summ/count($d->pacients),2);
            $rowA='A'.$activeRow;
            $rowB='B'.$activeRow;
            $rowC='C'.$activeRow;
            $rowD='D'.$activeRow;
            $sheet->setCellValue($rowA, $d->name);
            $sheet->setCellValue($rowB, count($d->pacients));
            $sheet->setCellValue($rowC, $d->summ);
            $sheet->setCellValue($rowD, $d->chek);


            $activeRow++;
        }
        $rowA='A'.$activeRow;
        $rowB='B'.$activeRow;
        $rowC='C'.$activeRow;
        $rowD='D'.$activeRow;
        $sheet->setCellValue($rowC, $totalSumm);
        $sheet->mergeCells($rowA.':'.$rowB);

        $sheet->getStyle('A4:' . $rowD)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setWidth(35);
        $sheet->getColumnDimension('B')->setWidth(17);





        $filename='/_Отчет по специалистам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';


        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports') ;

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }

        return $this->render('report_spec', compact('date'));


    }

    public function actionReport_dolg(){
        $date=date('d.m.Y');

        return $this->render('report_dolg', compact('date'));
    }

    public function actionReport_dolg_form()
    {
        $date = date('d.m.Y');

        Yii::setAlias('@reports', Yii::$app->basePath . '/reports');
        $firstdate = ($_GET['FIRST_DATE']);
        $secondtdate = ($_GET['SECOND_DATE']);
        $visitDolg=Vizit::find()->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->andWhere(['>', 'DOLG', 0])->all();

        $spreadsheet=new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));
        $sheet->setCellValue('A2', 'Отчет по долгам');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:F2');
        $titles = array(
            array(
                'name' => 'Дата',
                'cell' => 'A',
            ),
            array(
                'name' => 'Клиент, пациент',
                'cell' => 'B',
            ),
            array(
                'name' => 'Сумма',
                'cell' => 'C',
            ),


        );
        for ($j = 0; $j < count($titles); $j++) {

            $string = $titles[$j]['name'];
            $cellLatter = $titles[$j]['cell'] . 4;
            $sheet->setCellValue($cellLatter, $string);
        }
        $dolgs=[];
        $totalSumm=0;
        for($i=0;$i<count($visitDolg);$i++){
            $idVisit=$visitDolg[$i]->ID_VISIT;
            if(!array_key_exists($visitDolg[$idVisit], $dolgs)){
                $dolgs[$idVisit]=new Dolg();

                $client=Client::findOne(['ID_CL'=>$visitDolg[$i]->ID_CL]);
                $pacient=Pacient::findOne(['ID_PAC'=>$visitDolg[$i]->ID_PAC]);
                $dolgs[$idVisit]->dolgDate=date('d.m.Y', strtotime($visitDolg[$i]->DATE));
                $dolgs[$idVisit]->pacient=$pacient->KLICHKA;
                $dolgs[$idVisit]->fio=$client->FAM.' '.$client->NAME.' '.$client->OTCH;
                $dolgs[$idVisit]->summ=$visitDolg[$i]->DOLG;
                $totalSumm=$dolgs[$idVisit]->summ+$totalSumm;

            }

        }

        $activeRow=5;
        foreach ($dolgs as $dolg) {
            $cellA='A'.$activeRow;
            $cellB='B'.$activeRow;
            $cellC='C'.$activeRow;

            $sheet->setCellValue($cellA, $dolg->dolgDate);
            $sheet->setCellValue($cellB, $dolg->fio.', '.$dolg->pacient);
            $sheet->setCellValue($cellC, $dolg->summ);
            $activeRow++;

        }
        $cellA='A'.$activeRow;
        $cellB='B'.$activeRow;
        $cellC='C'.$activeRow;
        $sheet->setCellValue($cellC, $totalSumm);
        $sheet->mergeCells($cellA.':'.$cellB);
        $sheet->getStyle('A4:' . $cellC)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(42);







        $filename='/_Отчет по долгам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports');

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }


        return $this->render('report_dolg', compact('date'));
    }

    public function actionReport_newpacient(){
        $date=date('d.m.Y');
        return $this->render('report_newpacient', compact('date'));
    }

    public function actionReport_newpacient_form()
    {
        $date = date('d.m.Y');

        Yii::setAlias('@reports', Yii::$app->basePath . '/reports');
        $firstdate = ($_GET['FIRST_DATE']);
        $secondtdate = ($_GET['SECOND_DATE']);
        $spreadsheet= new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));
        $sheet->setCellValue('A2', 'Отчет по новым пациентам');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:F2');
        $titles = array(
            array(
                'name' => '№',
                'cell' => 'A',
            ),
            array(
                'name' => 'Клиент',
                'cell' => 'B',
            ),
            array(
                'name' => 'Пациент',
                'cell' => 'C',
            ),
            array(
                'name' => 'Дата первого визита',
                'cell' => 'D',
            ),


        );
        for ($j = 0; $j < count($titles); $j++) {

            $string = $titles[$j]['name'];
            $cellLatter = $titles[$j]['cell'] . 4;
            $sheet->setCellValue($cellLatter, $string);
        }
        $newPacients=Pacient::find()->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();
        $pacients=[];
        for($i=0;$i<count($newPacients);$i++){
            $idPac=$newPacients[$i]->ID_PAC;
            $client=Client::findOne(['ID_CL'=>$newPacients[$i]->ID_CL]);

            if(!array_key_exists($idPac, $pacients)){
                $pacients[$idPac]= new NewPacient();
                $pacients[$idPac]->fio= $client->FAM.' '.$client->NAME.' '.$client->OTCH;
                $vid=Vid::findOne(['ID_VID'=>$newPacients[$i]->ID_VID]);
                $pacients[$idPac]->name=$newPacients[$i]->KLICHKA;
                $pacients[$idPac]->vid=$vid->NAMEVID;
                $pacients[$idPac]->date=date('d.m.Y', strtotime($newPacients[$i]->DATE));
            }
        }
        $activeRow=5;
        $rowCount=1;
        foreach ($pacients as $pacient){
            $cellA='A'.$activeRow;
            $cellB='B'.$activeRow;
            $cellC='C'.$activeRow;
            $cellD='D'.$activeRow;

            $sheet->setCellValue($cellA, $rowCount);
            $sheet->setCellValue($cellB, $pacient->fio);
            $sheet->setCellValue($cellC, $pacient->vid.' '.$pacient->name);
            $sheet->setCellValue($cellD, $pacient->date);
            $rowCount++;
            $activeRow++;
        }


        $sheet->getStyle('A4:' . $cellD)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(42);
        $sheet->getColumnDimension('C')->setWidth(22);
        $sheet->getColumnDimension('D')->setWidth(20);




        $filename='/_Отчет по новым пациентам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports');

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }

        return $this->render('report_newpacient', compact('date'));
    }
    public function actionReport_predusl(){
        $date=date('d.m.Y');
        return $this->render('report_predusl', compact('date'));
    }
    public function actionReport_predusl_form(){
        $date=date('d.m.Y');
        Yii::setAlias('@reports', Yii::$app->basePath . '/reports');
        $firstdate = ($_GET['FIRST_DATE']);
        $secondtdate = ($_GET['SECOND_DATE']);
        $spreadsheet= new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));
        $sheet->setCellValue('A2', 'Отчет по предстоящим услугам');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:F2');
        $titles = array(
            array(
                'name' => 'Дата слeд.',
                'cell' => 'A',
            ),
            array(
                'name' => 'Дата',
                'cell' => 'B',
            ),
            array(
                'name' => 'Услуга',
                'cell' => 'C',
            ),
            array(
                'name' => 'Клиент',
                'cell' => 'D',
            ),
            array(
                'name' => 'Пациент',
                'cell' => 'E',
            ),
            array(
                'name' => 'Телефоны',
                'cell' => 'F',
            ),


        );
        for ($j = 0; $j < count($titles); $j++) {

            $string = $titles[$j]['name'];
            $cellLatter = $titles[$j]['cell'] . 4;
            $sheet->setCellValue($cellLatter, $string);
        }
        $facility=Sl_vakc::find()->where(['between', 'DATASL', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();


        $uslugi=[];

        for($i=0;$i<count($facility);$i++){
            $idFacility=$facility[$i]->ID_SLV;

            $usl=Price::findOne(['ID_PR'=>$facility[$i]->ID_PR]);
            $pacient=Pacient::findOne(['ID_PAC'=>$facility[$i]->ID_PAC]);
            $client=Client::findOne(['ID_CL'=>$pacient->ID_CL]);


            if(!array_key_exists($idFacility,$uslugi)){

                $uslugi[$idFacility]=new Predusl();
                $uslugi[$idFacility]->firstdate=date('d.m.Y', strtotime($facility[$i]->DATA));
                $uslugi[$idFacility]->seconddate=date('d.m.Y', strtotime($facility[$i]->DATASL));
                $uslugi[$idFacility]->usluga=$usl->NAME;
                $uslugi[$idFacility]->fio=$client->FAM.' '.$client->NAME.' '.$client->OTCH;
                $uslugi[$idFacility]->pacient=$pacient->KLICHKA;
                $uslugi[$idFacility]->numbers=$client->PHONED.', '.$client->PHONES;


            }


        }
        $activeRow=5;
        foreach ($uslugi as $usluga){
            $cellA='A'.$activeRow;
            $cellB='B'.$activeRow;
            $cellC='C'.$activeRow;
            $cellD='D'.$activeRow;
            $cellE='E'.$activeRow;
            $cellF='F'.$activeRow;

            $sheet->setCellValue($cellA, $usluga->seconddate);
            $sheet->setCellValue($cellB, $usluga->firstdate);
            $sheet->setCellValue($cellC, $usluga->usluga);
            $sheet->setCellValue($cellD, $usluga->fio);
            $sheet->setCellValue($cellE, $usluga->pacient);
            $sheet->setCellValue($cellF, $usluga->numbers);
            $activeRow++;
        }

        $sheet->getStyle('A4:' . $cellF)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(40);
        $sheet->getColumnDimension('E')->setWidth(21);
        $sheet->getColumnDimension('F')->setWidth(40);




        $filename='/_Отчет по предстоящим услугам c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports');

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }
        return $this->render('report_predusl', compact('date'));
    }

    public function actionReport_pay(){
        $date=date('d.m.Y');
        return $this->render('report_pay', compact('date'));
    }

    public function actionReport_pay_form(){
        function dump($arr){
            echo '<pre>'.print_r($arr, true).'</pre>';
        }
        $date=date('d.m.Y');
        Yii::setAlias('@reports', Yii::$app->basePath . '/reports');
        $firstdate = ($_GET['FIRST_DATE']);
        $secondtdate = ($_GET['SECOND_DATE']);
        $spreadsheet= new Spreadsheet();
        $tempFacilities=Facility::find()
            ->where(['between', 'facility.DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
            ->joinWith('doctor')
            ->joinWith('price')
            ->asArray()->all();
        $facilities=[];
        $spdoc=[];
        $tempSpdoc=Spdoc::find()->all();
        $tempDoctors=Doctor::find()->asArray()->all();

        foreach ($tempSpdoc as $item){
            $spdoc[$item->ID_SPDOC]=$item->SP_DOC;
        }

        foreach ($tempFacilities as $item){
            $facilities[$item[ID_DOC]][doctor]=$item[doctor];
            $facilities[$item[ID_DOC]][facilities][$item[price][ID_SPDOC]][name]=$spdoc[$item[price][ID_SPDOC]];
            $facilities[$item[ID_DOC]][facilities][$item[price][ID_SPDOC]][items][$item[ID_FAC]]=$item;
        }
        foreach ($tempDoctors as $item){
            if(isset($facilities[$item[ID_DOC]])){
                $facilities[$item[ID_DOC]][percent]=[
                    1=>$item[THERAPY],
                    2=>$item[SURGERY],
                    3=>$item[UZI],
                    4=>$item[MED],
                    5=>$item[VAKC],
                    6=>$item[DEG],
                    7=>$item[ANALYZ],
                    8=>$item[KORM],
                ];
            }

        }


        $titles = array(
            array(
                'name' => 'Вид манипуляций',
                'cell' => 'A',
            ),
            array(
                'name' => 'Процент',
                'cell' => 'B',
            ),
            array(
                'name' => 'Сумма поступлений',
                'cell' => 'C',
            ),
            array(
                'name' => 'Зарплата',
                'cell' => 'D',
            ),

        );


//        dump($facilities);
        $titelsRow=4;
        $i=1;
        $total=[];
        $totalSumm=0;
        $totalPercentSumm=0;
        foreach ($facilities as $doctor){
            $spreadsheet->createSheet();
            $sheet = $spreadsheet->setActiveSheetIndex($i);
            $sheet->setTitle($doctor[doctor][NAME]);
            $sheet->setCellValue('A1', 'ЗооДоктор');
            $sheet->setCellValue('D1', date("d.m.Y"));
            $sheet->setCellValue('A2', "Расчет зарплаты:".$doctor[doctor][NAME]);
            $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
            $sheet->mergeCells('A2:F2');

            foreach ($titles as $title){
                $sheet->setCellValue($title['cell'].$titelsRow,$title['name']);
                $sheet->getColumnDimension($title['cell'])->setAutoSize(true);
            }

            $activeRow=5;

            $docSumm=0;
            $docPercentSumm=0;
            foreach ($doctor[facilities] as $key=>$spdoctor){
                $sheet->setCellValue("A$activeRow", $spdoctor[name]);
                $summ=0;
                foreach ($spdoctor[items] as $item){
                    $summ+=$item[SUMMA];
                    $docSumm+=$item[SUMMA];
                    $total[$key][summ]+=$item[SUMMA];
                }
                $sheet->setCellValue("B$activeRow", $doctor[percent][$key]);
                $sheet->setCellValue("C$activeRow", $summ);
                $percentSumm=$summ*($doctor[percent][$key]/100);
                $docPercentSumm+=$percentSumm;
//                $totalPercentSumm+=$percentSumm;
                $total[$key][vipl]+=$percentSumm;
                $sheet->setCellValue("D$activeRow", $percentSumm);
                $activeRow++;
            }
            $sheet->setCellValue("C$activeRow", $docSumm);
            $sheet->setCellValue("D$activeRow", $docPercentSumm);
            $sheet->mergeCells("A$activeRow:B$activeRow");
            $sheet->getStyle("A4:D$activeRow")
                ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $i++;
        }
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        $sheet->getColumnDimension("A")->setAutoSize(true);
        $sheet->getColumnDimension("B")->setAutoSize(true);
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->setTitle("ИТОГ");
        $sheet->setCellValue("A1", "ИТОГ");
        $activeRow=2;
        $sheet->setCellValue("A2","Вид манипуляций");
        $sheet->setCellValue("B2","Сумма поступлений");
        $sheet->setCellValue("C2","Сумма выплат");
        $activeRow++;
        $totalVipl=0;
        $totalSumm=0;

        foreach ($total as $key=>$item){
            $sheet->setCellValue("A$activeRow", $spdoc[$key]);
            $sheet->setCellValue("B$activeRow", $item[summ]);
            $sheet->setCellValue("C$activeRow", $item[vipl]);
            $totalSumm+=$item[summ];
            $totalVipl+=$item[vipl];
            $activeRow++;
        }
        $sheet->setCellValue("B$activeRow", $totalSumm);
        $sheet->setCellValue("C$activeRow", $totalVipl);
        $sheet->getStyle("A2:C$activeRow")
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);




        $filename='/_Расчет зарплаты c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports');

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }
        return $this->render('report_pay', compact('date'));

    }

    public function actionReport_stat(){
        $date=date('d.m.Y');

        return $this->render('report_stat', compact('date'));
    }

    public function actionReport_stat_form(){
        $date=date('d.m.Y');
        Yii::setAlias('@reports', Yii::$app->basePath . '/reports');
        $firstdate = ($_GET['FIRST_DATE']);
        $secondtdate = ($_GET['SECOND_DATE']);
        $spreadsheet= new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));
        $sheet->setCellValue('A2', 'Средние данные');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:D2');
        $d1_ts = strtotime($firstdate);
        $d2_ts = strtotime($secondtdate);

        $seconds = abs($d1_ts - $d2_ts);
        $days=floor($seconds / 86400);

        $sheet->setCellValue('E2','Количество дней: '.$days);

        $sheet->setCellValue('A5','Количество пациентов за период:');
        $sheet->setCellValue('A6','Сумма выручки за период:');
        $sheet->setCellValue('A7','Ср. количество пациентов в сутки:');
        $sheet->setCellValue('A8','Ср. сумма чека:');
        $sheet->setCellValue('A9','Ср. выручка в сутки:');
        $sheet->getColumnDimension('A')->setWidth(34);

        $facility=Facility::find()->where(['between', 'DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();
        $totalSumm=0;
        $visits=Vizit::find()->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();
        foreach ($visits as $visit){
            $totalSumm=$totalSumm+($visit->SUMMAV-$visit->DOLG);
        }

        $sheet->setCellValue('B5', count($facility));
        $sheet->setCellValue('B6', $totalSumm);
        $sheet->setCellValue('B7', count($facility)/$days);
        $sheet->setCellValue('B8', $totalSumm/count($visits));
        $sheet->setCellValue('B9', $totalSumm/$days);
        $sheet->getColumnDimension('E')->setWidth(20);




        $filename='/_Средние данные с'.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports');

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }


        return $this->render('report_stat', compact('date'));
    }
    public function actionReport_expiration(){
        $date=date('d.m.Y');



        return $this->render('report_expiration',compact('date'));
    }
    public function actionReport_expiration_form(){

        Yii::setAlias('@reports', Yii::$app->basePath . '/reports');
        $firstdate = ($_GET['FIRST_DATE']);
        $secondtdate = ($_GET['SECOND_DATE']);


        $spreadsheet= new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));
        $sheet->setCellValue('A2', 'Просроченные товары');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:D2');

        $sheet->setCellValue('A4','Наименование товара');
        $sheet->setCellValue('B4','Срок годности');
        $sheet->setCellValue('C4','Кол-во');
        $sheet->setCellValue('D4','Цена закупки');
        $sheet->setCellValue('E4','Цена продажи');
        $sheet->setCellValue('F4','Сумма');
        $sheet->getColumnDimension('A')->setWidth(34);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(8);
        $sheet->getColumnDimension('D')->setWidth(13);
        $sheet->getColumnDimension('E')->setWidth(14);
        $sheet->getColumnDimension('F')->setWidth(12);

        $tovars=Prihod_tovara::find()->where(['between', 'EXPIRATION_DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->andWhere(['>', 'KOL', 0])->joinWith('tovar')->orderBy([
            'NAME' => SORT_ASC,
        ])->all();
        $activeRow=5;
        $totalSumm=0;
        foreach ($tovars as $tovar){

            $cellA='A'.$activeRow;
            $cellB='B'.$activeRow;
            $cellC='C'.$activeRow;
            $cellD='D'.$activeRow;
            $cellE='E'.$activeRow;
            $cellF='F'.$activeRow;

            $totalSumm=$totalSumm+$tovar->SUMM;


            $sheet->setCellValue($cellA, $tovar->tovar->NAME);
            $sheet->setCellValue($cellB, $tovar->EXPIRATION_DATE);
            $sheet->setCellValue($cellC, $tovar->KOL);
            $sheet->setCellValue($cellD, $tovar->PRICE);
            $sheet->setCellValue($cellE, $tovar->SELL_PRICE);
            $sheet->setCellValue($cellF, $tovar->SUMM);

            $activeRow++;

        }
        $cellF='F'.$activeRow;
        $cellE='E'.$activeRow;
        $cellA='A'.$activeRow;

        $sheet->setCellValue($cellF, $totalSumm);


        $sheet->mergeCells($cellA.':'.$cellE);
        $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A4:' . $cellF)
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);




        $filename='/_Отчет по сроку годности с '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports');

        $file = $path.$filename;
        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }

    }
    public function actionReport_dolg_payment(){
        $date=date('d.m.Y');
        return $this->render("report_dolg_payment", compact("date"));
    }

    public function actionReport_dolg_payment_form(){
        Yii::setAlias('@reports', Yii::$app->basePath.'/reports');
        $firstdate= ($_GET['FIRST_DATE']);
        $secondtdate= ($_GET['SECOND_DATE']);

        $firstdate =date("Y-m-d", strtotime($firstdate));
        $secondtdate =date("Y-m-d", strtotime($secondtdate));

        //массив заголовков столбцов
        $titles = array(
            array(
                'name' => 'Дата внесения',
                'cell' => 'A',
                "width"=>"15",
            ),
            array(
                'name' => 'Клиент',
                'cell' => 'B',
                "width"=>"15",
            ),
            array(
                'name' => 'Пациент',
                'cell' => 'C',
                "width"=>"15",
            ),
            array(
                'name' => 'Визит',
                'cell' => 'D',
                "width"=>"15",
            ),
            array(
                'name' => 'Дата визита',
                'cell' => 'E',
                "width"=>"15",
            ),
            array(
                'name' => 'Наличные',
                'cell' => 'F',
                "width"=>"15",
            ),
            array(
                'name' => 'Б/нал',
                'cell' => 'G',
                "width"=>"15",
            ),


        );
        //шапка отчета
        $spreadsheet=new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));

        $sheet->setCellValue('A2', 'Отчет по оплате долгов');
        $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
        $sheet->mergeCells('A2:F2');

        $titelsRow=4;
        foreach ($titles as $title){
            $sheet->setCellValue($title['cell'].$titelsRow,$title['name']);
            $sheet->getColumnDimension($title['cell'])->setAutoSize(true);
        }
        $payments=Oplata::find()
            ->joinWith("client")
            ->joinWith("visit")
            ->joinWith("pacient")
            ->where(['between', 'oplata.DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
            ->andWhere(["oplata.IsDolg"=>1])
            ->all();
        $activeRow=5;
        foreach ($payments as $payment){

            $sheet->setCellValue("A$activeRow", date("d.m.Y", strtotime($payment->DATE)));
            $sheet->setCellValue("B$activeRow", $payment->client->FAM
                . ' ' . mb_substr($payment->client->NAME, 0, 1) . '. ' . mb_substr($payment->client->OTCH, 0, 1) . '.');
            $sheet->getCell("B$activeRow")
                ->getHyperlink()->setUrl("http://vetcms/web/index.php?r=client/anketa&clientId=$payment->ID_CL");
            $sheet->setCellValue("C$activeRow", $payment->pacient->KLICHKA);
            $sheet->setCellValue("D$activeRow", $payment->ID_VIZIT);
            $sheet->getCell("D$activeRow")
                ->getHyperlink()->setUrl("http://vetcms/web/index.php?r=client/visit&ID_VISIT=$payment->ID_VIZIT");
            $sheet->setCellValue("E$activeRow", date("d.m.Y", strtotime($payment->visit->DATE)));
            if($payment->VID_OPL==0){
                $sheet->setCellValue("F$activeRow", $payment->SUMM);
                $totalNal=$totalNal+$payment->SUMM;
            }else{
                $sheet->setCellValue("G$activeRow", $payment->SUMM);
                $totalBnal=$totalBnal+$payment->SUMM;
            }

            $activeRow++;
        }
        $sheet->getStyle("A4:G$activeRow")
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        //вывод итоговой строки отчета
        $sheet->setCellValue("E$activeRow", "Итого:");
        $sheet->setCellValue("F$activeRow", $totalNal);
        $sheet->setCellValue("G$activeRow", $totalBnal);
        $sheet->getStyle("D$activeRow:G$activeRow")
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        $sheet->mergeCells("A$activeRow:D$activeRow");

        $filename='/_Отчет по оплате долгов c '.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports') ;

        $file = $path.$filename;


        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }

    }
    public function actionReport_vakcine(){
        $date=date('d.m.Y');
        return $this->render("report_vakcine", compact("date"));
    }

    public function actionReport_vakcine_form(){
        Yii::setAlias('@reports', Yii::$app->basePath.'/reports');
        $firstdate= ($_GET['FIRST_DATE']);
        $secondtdate= ($_GET['SECOND_DATE']);

        $firstdate =date("Y-m-d", strtotime($firstdate));
        $secondtdate =date("Y-m-d", strtotime($secondtdate));

        //---------------------------------по всем расходникам-------------------------------------
        if($_GET["vid"]==9999){
            //массив заголовков столбцов
            $titles = array(
                array(
                    'name' => 'Наименование расходника',
                    'cell' => 'A',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Потречено за период',
                    'cell' => 'B',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Текущий остаток',
                    'cell' => 'C',
                    "width"=>"15",
                ),

            );
            //шапка отчета
            $spreadsheet=new Spreadsheet();
            $sheet=$spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ЗооДоктор');
            $sheet->setCellValue('D1', date("d.m.Y"));

            $sheet->setCellValue('A2', 'Отчет  по расходникам');
            $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
            $sheet->mergeCells('A2:F2');

            $titelsRow=4;
            foreach ($titles as $title){
                $sheet->setCellValue($title['cell'].$titelsRow,$title['name']);
                $sheet->getColumnDimension($title['cell'])->setAutoSize(true);
            }

//            $tempExpenses=Expense_catalog::find()->joinWith('price')->all();
            $tempExpenses=Price::find()->where(['IsCount'=>1])->all();
            $ids=[];
            $expenses=[];
            foreach($tempExpenses as $item){
                array_push($ids, $item->ID_PR);
                $expenses[$item->ID_PR]=[
                    'name'=>$item->NAME,
                    'currentCount'=>$item->KOL,
                    'vidIzm'=>$item->IZM,
                    'used'=>0,
                ];
            }

            $facilities=Facility::find()->where(['between', 'DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(['in', 'ID_PR', $ids])
                ->all();

            foreach ($facilities as $item){
                $expenses[$item->ID_PR][used]+=$item->KOL;
            }

            $activeRow=4;
            foreach ($expenses as $item){
                $activeRow++;
                if($item[vidIzm]==0){
                    $vidIzm='шт.';
                }else{
                    $vidIzm='мл.';
                }
                $sheet->setCellValue("A$activeRow", $item[name]." ($vidIzm)");
                $sheet->setCellValue("B$activeRow", $item[used]);
                $sheet->setCellValue("C$activeRow", $item[currentCount]);
            }
            $sheet->getStyle("A4:C$activeRow")
                ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $filename='/_Отчет по расходникам с'.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save(Yii::getAlias('@reports').$filename);
            $path = \Yii::getAlias('@reports') ;

            $file = $path.$filename;


            if (file_exists($file)) {
                \Yii::$app->response->sendFile($file);
            }else {
                throw new \Exception('Файл не найден');
            }
        }else{
            //массив заголовков столбцов
            $titles = array(
                array(
                    'name' => 'Наименование расходника',
                    'cell' => 'A',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Потречено за период',
                    'cell' => 'B',
                    "width"=>"15",
                ),
                array(
                    'name' => 'Текущий остаток',
                    'cell' => 'C',
                    "width"=>"15",
                ),

            );
            //шапка отчета
            $spreadsheet=new Spreadsheet();
            $sheet=$spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ЗооДоктор');
            $sheet->setCellValue('D1', date("d.m.Y"));

            $sheet->setCellValue('A2', 'Отчет  по расходникам');
            $sheet->setCellValue('A3', ' с ' . date("d.m.Y", strtotime($firstdate)) . ' по ' . date("d.m.Y", strtotime($secondtdate)));
            $sheet->mergeCells('A2:F2');

            $titelsRow=4;
            foreach ($titles as $title){
                $sheet->setCellValue($title['cell'].$titelsRow,$title['name']);
                $sheet->getColumnDimension($title['cell'])->setAutoSize(true);
            }

//            $tempExpenses=Expense_catalog::find()->joinWith('price')->where(['price.ID_SPDOC'=>$_GET['vid']])->all();
            $tempExpenses=Price::find()->where(['IsCount'=>1])->andWhere(['ID_SPDOC'=>$_GET['vid']])->all();
            $ids=[];
            $expenses=[];
            foreach($tempExpenses as $item){
                array_push($ids, $item->ID_PR);
                $expenses[$item->ID_PR]=[
                    'name'=>$item->NAME,
                    'currentCount'=>$item->KOL,
                    'vidIzm'=>$item->IZM,
                    'used'=>0,
                ];
            }

            $facilities=Facility::find()->where(['between', 'DATA', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])
                ->andWhere(['in', 'ID_PR', $ids])
                ->all();

            foreach ($facilities as $item){
                $expenses[$item->ID_PR][used]+=$item->KOL;
            }

            $activeRow=4;
            foreach ($expenses as $item){
                $activeRow++;
                if($item[vidIzm]==0){
                    $vidIzm='шт.';
                }else{
                    $vidIzm='мл.';
                }
                $sheet->setCellValue("A$activeRow", $item[name]." ($vidIzm)");
                $sheet->setCellValue("B$activeRow", $item[used]);
                $sheet->setCellValue("C$activeRow", $item[currentCount]);
            }
            $sheet->getStyle("A4:C$activeRow")
                ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $filename='/_Отчет по расходникам с'.date("d.m.Y", strtotime($firstdate)).' по '.date("d.m.Y", strtotime($secondtdate)).'.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save(Yii::getAlias('@reports').$filename);
            $path = \Yii::getAlias('@reports') ;

            $file = $path.$filename;


            if (file_exists($file)) {
                \Yii::$app->response->sendFile($file);
            }else {
                throw new \Exception('Файл не найден');
            }
        }


    }

    public function actionReport_ostatki(){
        $date=date('d.m.Y');
        return $this->render("report_ostatki", compact("date"));
    }

    public function actionReport_ostatki_form(){
        Yii::setAlias('@reports', Yii::$app->basePath.'/reports');


        $titles = array(
            array(
                'name' => 'ID поступления',
                'cell' => 'A',
                "width"=>"10",
            ),
            array(
                'name' => 'Наимменование',
                'cell' => 'B',
                "width"=>"30",
            ),
            array(
                'name' => 'Цена продажи',
                'cell' => 'C',
                "width"=>"15",
            ),
            array(
                'name' => 'Остаток',
                'cell' => 'D',
                "width"=>"15",
            ),

        );
        //шапка отчета
        $spreadsheet=new Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ЗооДоктор');
        $sheet->setCellValue('D1', date("d.m.Y"));

        $sheet->setCellValue('A2', 'Отчет по остаткам (магазин)');
        $sheet->mergeCells('A2:F2');

        $titelsRow=4;
        foreach ($titles as $title){
            $sheet->setCellValue($title['cell'].$titelsRow,$title['name']);
            $sheet->getColumnDimension($title['cell'])->setWidth($title['width']);
        }
        $ostatki=Prihod_tovara::find()->joinWith('tovar')
            ->where(['>', 'prihod_tovara.KOL', 0])
            ->orderBy([
                'NAME' => SORT_ASC,
            ])
            ->all();
        $activeRow=5;
        foreach ($ostatki as $item){
            $sheet->setCellValue("A$activeRow", "$item->ID_PRIHOD");
            $sheet->setCellValue("B$activeRow", $item->tovar->NAME);
            $sheet->setCellValue("C$activeRow", "$item->SELL_PRICE");
            $sheet->setCellValue("D$activeRow", "$item->KOL");
            $activeRow++;
        }





        $sheet->getStyle("A4:D$activeRow")
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $filename='/_Отчет по остаткам (магазин) от '.date('d.m.Y').'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(Yii::getAlias('@reports').$filename);
        $path = \Yii::getAlias('@reports') ;

        $file = $path.$filename;


        if (file_exists($file)) {
            \Yii::$app->response->sendFile($file);
        }else {
            throw new \Exception('Файл не найден');
        }
    }


}