<?php


namespace app\controllers;

use app\models\Old_postup;
use app\models\Prihod_tovara;
use app\models\User;
use Yii;
use app\models\Sl_vakc;
use app\models\Facility;
use app\models\Vizit;
class MigrationController extends AppController
{
    public $layout = 'basic';

    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        $session = Yii::$app->session;

        if ($session->get('authToken') === NULL) {
            $this->redirect("index.php?r=auth/login");
        } else if (User::findByToken($session->get('authToken')) == NULL) {
            $this->redirect("index.php?r=auth/logout");
        }
        return parent::beforeAction($action);
    }

    public function actionShop(){

        if($_GET['key']!=="mOgrtVrohfzS"){
            exit;
        }
        $oldPostup=Yii::$app->db->createCommand("SELECT * FROM old_postup")->queryAll();

        foreach ($oldPostup as $key=>$item){
            $oldPostup[$key][DPOSTUP]=(date('Y-m-d', strtotime($item['DPOSTUP'])));
            $valuesSting .= "('".$item[ID_TOV]."', '".$item[KOL]*$item[PRICE_Z]."', '".$oldPostup[$key][DPOSTUP]."', '".$item['OSTATOK']."', '".$item['PRICE_P']."', '".$item['PRICE_Z']."', 'NULL'),";
        }

        $valuesSting=mb_substr($valuesSting, 0, strlen($valuesSting)-1);
        $valuesSting.=";";
        $query = "INSERT INTO prihod_tovara (ID_TOV, SUMM, DATE, KOL, SELL_PRICE, PRICE, EXPIRATION_DATE) VALUES $valuesSting";
//        $query= "DELETE FROM prihod_tovara WHERE DATE < '2018-01-01'";
//        $query= "DELETE FROM prihod_tovara";

//        Yii::$app->db->createCommand($query)->execute();

        return $this->render('shop', compact('oldPostup'));
    }
    public function actionShop_delete_duplicate(){
        function dump($arr){
            echo '<pre>'.print_r($arr, true).'</pre>';
        }
        $products=Prihod_tovara::find()->all();
        $duplicates=[];
        $uniquePrihod=[];
        $resultArray=[];
        foreach ($products as $item){
            if($item->KOL==0){
                $duplicates[$item->ID_PRIHOD]=$item->ID_TOV.":::".$item->SELL_PRICE;
            }
        }
        foreach ($duplicates as $key=>$item){
            if(!in_array($item, $uniquePrihod)){
                $uniquePrihod[$key]=$item;
                unset($duplicates[$key]);
            }else{
                array_push($resultArray, $key);
            }
        }
        $resultString=implode(",", $resultArray);
        dump($resultString);
//        $query = "DELETE FROM actual_VET_cms.prihod_tovara WHERE ID_PRIHOD IN ($resultString)";
        dump($query);

//        Yii::$app->db->createCommand($query)->execute();
        return $this->render('Shop_delete_duplicate.php', compact('duplicates'));
    }
    public function actionSl_vakc_migration(){
        function dump($arr){
            echo '<pre>'.print_r($arr, true).'</pre>';
        }
        $vakcs=Sl_vakc::find()->all();
        foreach ($vakcs as $item){
            $date=date('Y-m-d', strtotime($item->DATA));
            $datesl=date('Y-m-d', strtotime($item->DATASL));
            $query = "UPDATE actual_VET_cms.sl_vakc SET DATA='$date', DATASL='$datesl' WHERE ID_SLV=$item->ID_SLV";
            Yii::$app->db->createCommand($query)->execute();
        }
        return $this->render('Sl_vakc_migration');
    }


    public function actionDelete_duplicate(){
        $firstdate="2020-09-01";
        $secondtdate="2020-10-05";
        $temp=Vizit::find()->where(['between', 'DATE', date('Y-m-d',strtotime($firstdate)),date('Y-m-d',strtotime($secondtdate))])->all();
        $visits=[];
        foreach($temp as $visit){
            $visits[$visit[ID_VISIT]]=[];
        }
        $final=[];
        $duplicates=[];
        foreach($visits as $id=>$visit){
            $final[$id]=[];
            $temp=Facility::find()->where(["ID_VISIT"=>$id])->all();
            foreach($temp as $fac){
                if(!array_key_exists($fac[ID_PR], $final[$id])){
                    $final[$id][$fac[ID_PR]]=$fac[KOL];
                }else{
                    if($fac[KOL]==$final[$id][$fac[ID_PR]] AND !in_array($id, $duplicates)){
                        array_push($duplicates, $id);
                    }
                }
            } 
        }
        // foreach($duplicates as $duplicate){
        //     $facilities=Facility::find()->where(["ID_VISIT"=>$duplicate])->all();
            
        //     $i=count($facilities)-1;
        //     $dupArr=[];
        //     $toDelete=[];
        //     foreach($facilities as $fac){
        //         if(!array_key_exists($fac['ID_PR'], $dupArr)){
        //             $dupArr[$fac['ID_PR']]=$fac['KOL'];
        //         }else{
        //             if($dupArr[$fac['ID_PR']]==$fac['KOL']){
        //                 array_push($toDelete, $fac['ID_FAC']);
        //             }
        //         }
        //     }
            
        // }
        

        return $this->render('Delete_duplicate', compact('duplicates'));
    }
}


