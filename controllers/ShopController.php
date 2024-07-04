<?php
namespace app\controllers;

use app\models\GoodsCodesForm;
use app\models\GoodsImportForm;
use app\models\KattovForm;
use app\models\Prihod_tovaraForm;
use app\models\SaleChecksForm;
use app\models\User;

use MyUtility\MyUtility;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\UploadedFile;


class ShopController extends AppController
{
    public $layout='basic';


    public function beforeAction($action) {
        if ($action->id=='index'){
            $this->enableCsrfValidation=false;
        }

        $session = Yii::$app->session;

        if ($session->get('authToken') === NULL) {
            $this->redirect("index.php?r=auth/login");
        } else if (User::findByToken($session->get('authToken')) == NULL) {
            $this->redirect("index.php?r=auth/logout");
        }

        return parent::beforeAction($action);
    }


    public function actionGoodsimport() {
        $goodsImport = new GoodsImportForm();


        if ($goodsImport->load(Yii::$app->request->post())) {
            $csvFile = UploadedFile::getInstance($goodsImport, 'csvFile');
            $rawGoods = MyUtility::CsvExplode($csvFile->tempName, ';');
            $goodsCodes = GoodsCodesForm::find()->select('code')->asArray()->column();

            foreach ($rawGoods as $rawGood) {

                //sourceTemplate
                //делаю пока только импорт из СБИС, потом переделать под шаблоны
                //проверка на наличие кода в товара в базе
                if (!in_array($rawGood[2], $goodsCodes)) {
                    //$sql = "INSERT INTO kattov(kattov.NAME, kattov.country, kattov.description) VALUES ($rawGood[2], $rawGood[17], $rawGood[16]), ('test2', 'test2', 'test2')";
                    //добавление нового товара
                    $goodModel = new KattovForm();
                    $goodModel->NAME = $rawGood[0];
                    $goodModel->country = $rawGood[17];
                    $goodModel->description = $rawGood[16];
                    $goodModel->save();
                    $goodId = Yii::$app->db->lastInsertID;
                    //добавление кода товара
                    $sql = "INSERT INTO goods_codes(goods_codes.sourceId, goods_codes.goodId, goods_codes.code) VALUES (1, $goodId, '$rawGood[2]')";
                    Yii::$app->db->createCommand($sql)->execute();

                    //добавление ШТРИХ-кодов товара
                    $barcodes = explode(',', str_replace(' ', '', $rawGood[10]));
                    $barcodesStr = "";

                    foreach ($barcodes as $barcode) {
                        $barcodesStr .= "($goodId, '$barcode', 1), ";
                    }
                    $barcodesStr = substr($barcodesStr, 0, -2);

                    $sql = "INSERT INTO goods_barcodes(goods_barcodes.goodId, goods_barcodes.barcode, goods_barcodes.barcodeFormat) VALUES $barcodesStr";
                    Yii::$app->db->createCommand($sql)->execute();
                    //добавление поступления
                    if ($rawGood[3] != '') {
                        $goodAdmissionModel = new Prihod_tovaraForm();
                        $goodAdmissionModel->ID_TOV = $goodId;
                        $goodAdmissionModel->EXPIRATION_DATE = '2030-01-01';
                        $goodAdmissionModel->SUMM = $rawGood[1] * $rawGood[3];
                        $goodAdmissionModel->DATE = date("Y-m-d");
                        $goodAdmissionModel->KOL = $rawGood[3];
                        $goodAdmissionModel->SELL_PRICE = $rawGood[1];
                        $goodAdmissionModel->PRICE = $rawGood[4];
                        $goodAdmissionModel->PRIM = 'В выгрузке из СБИС нет срока годности товаров';
                        $goodAdmissionModel->save();
                    }

                } else {
                    $goodModel = GoodsCodesForm::find()
                        ->leftJoin('kattov', 'goods_codes.goodId = kattov.ID_TOV')
                        ->where(['goods_codes.code' => $rawGood[2]])
                        ->one();

                    $sql = "SELECT goods_barcodes.barcode FROM goods_barcodes WHERE goods_barcodes.goodId = $goodModel->goodId";
                    $oldBarcodes = Yii::$app->db->createCommand($sql)->queryColumn();
                    $newBarcodes = explode(',', str_replace(' ', '', $rawGood[10]));
                    $newBarcodesStr = "";
                    $hasNewBarcodes = false;

                    foreach ($newBarcodes as $newBarcode) {
                        if (!in_array($newBarcode, $oldBarcodes)) {
                            $newBarcodesStr .= "($goodModel->goodId, '$newBarcode', 1), ";
                            $hasNewBarcodes = true;
                        }
                    }

                    if ($hasNewBarcodes) {
                        $newBarcodesStr = substr($newBarcodesStr, 0, -2);
                        $sql = "INSERT INTO goods_barcodes(goods_barcodes.goodId, goods_barcodes.barcode, goods_barcodes.barcodeFormat) VALUES $newBarcodesStr";
                        Yii::$app->db->createCommand($sql)->execute();
                        MyUtility::Dump('ABOBA');
                    }
                    //зарефакторить
                    if ($rawGood[3] != '') {
                        $goodAdmissionModel = new Prihod_tovaraForm();
                        $goodAdmissionModel->ID_TOV = $goodModel->goodId;
                        $goodAdmissionModel->EXPIRATION_DATE = '2030-01-01';
                        $goodAdmissionModel->SUMM = $rawGood[1] * $rawGood[3];
                        $goodAdmissionModel->DATE = date("Y-m-d");
                        $goodAdmissionModel->KOL = $rawGood[3];
                        $goodAdmissionModel->SELL_PRICE = $rawGood[1];
                        $goodAdmissionModel->PRICE = $rawGood[4];
                        $goodAdmissionModel->PRIM = 'В выгрузке из СБИС нет срока годности товаров';
                        $goodAdmissionModel->save();
                    }
                }
            }
//            if ($goodsImport->Import()) {
//                $this->redirect("index.php?r=clinic%2Fclinicpage");
//            }
        }

        return $this->render('goodsimport', compact('goodsImport'));
    }


    function actionWritebarcode(){
        //единственное адекватное мобильное приложение для отправки http(s) запросов сразу после скана кода некорректно отправляет get параметры
        $barcode = explode('?text=', $_SERVER['REQUEST_URI']);
        file_put_contents(__DIR__ . '/../widgets/scannedBarcode.txt', $barcode[1]);
    }


    function actionGetscannedgood(){
        $barcode = file_get_contents(__DIR__ . '/../widgets/scannedBarcode.txt');
        $sql = "SELECT goodId FROM goods_barcodes WHERE barcode = '$barcode'";
        $goodId = $goodId = Yii::$app->db->createCommand($sql)->queryOne()['goodId'];

        return $goodId;
    }


    function actionSalecheckspage(){
        $salesChecks = new ActiveDataProvider([
            'query' => SaleChecksForm::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('salecheckspage', compact('salesChecks'));
    }

    function file_force_download($file) {
        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }
    }

    function actionDownloadscanner(){
        $filePath = __DIR__ . '/../widgets/Scanner.apk';
        $this->file_force_download($filePath);
        readfile($filePath);
        exit;
    }
}