<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use MyUtility\MyUtility;

?>


<div class="container-fluid col-md-7 p-0 clientPagination" style="height:">

<?php Pjax::begin();
if ($answer==NULL){
    if ($_GET['FAM']!=''){
    $answer=$_GET['FAM'];
    }
}

$form = ActiveForm::begin(['options'=>['id'=>'searchForm','data-pjax' => true,]]) ?>
<?= $form->field($model, 'FAM')->textInput(['value'=>$answer, 'autofocus'=>'autofocus',
    'autocomplete'=>'off',
    'onfocus'=>'var temp_value=this.value; this.value=\'\'; this.value=temp_value'])?>

<?= Html::submitButton('Сохранить',['class'=>'btn btn-success', 'id'=>'searchSubmit', 'style'=>'display:none;'])?>



    <div id="searchResult">

        <?php  if ($searchProvider!=NULL){
            echo GridView::widget([
                'dataProvider' => $searchProvider,

                'columns'=>[
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}  {delete}',
                        'buttons'=>['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/anketa&clientId='.$key['ID_CL'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },
                            'delete'=>function($model, $key, $index){

                                $myurl='index.php?r=client/clientdelete&clientId='.$key['ID_CL'];

                                return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                    'title' => Yii::t('app', 'Удалить'),
                                ]);
                            },],

                    ],
                    'FAM',
                    'NAME',
                    'OTCH',
                ],
            ]);
            }

        ?>
    </div>
<?php $form = ActiveForm::end();

$js = <<<JS

 $('#searchform-fam').on('input', function(){
     if ($('#searchform-fam').val()!=''){
         
        
     }else{
         window.location = window.location.href  + '&FAM=';
         $('#clientPagination').css('display','');
     }
    
    document.getElementById('searchSubmit').click();
     
 });

$('.grid-view tbody tr').on('click', function()
{
   
     var fam =document.getElementById("searchform-fam").value;
    
    // window.location = window.location.href  + '&selectClientId='+ $(this).data('key')+'&FAM='+fam;
    var newUrl =updateURLParameter(window.location.href, 'selectClientId', $(this).data('key'));
    newUrl=updateURLParameter(newUrl, 'FAM', fam);
    window.location=newUrl;
    });
function updateURLParameter(url, param, paramVal){
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] != param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}
JS;

$this->registerJs($js);
Pjax::end();?>








    <div id="clientPagination">
<!--        Client pagination-->

    <div class="row center-block" style="margin-left: 30px">
<!--        <div class="col-md-9 p-0">--><?//=LinkPager::widget(['pagination'=>$pages, 'lastPageLabel'=>'>|', 'firstPageLabel'=>'|<', 'maxButtonCount'=>7])?><!--</div>-->

    </div>
        <div style="font-size: 130%">
            <div class="col"><a href="index.php?r=client/clientadd&clientId=new" class="btn btn-success">Добавить клиента</a></div>
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{summary}\n{items}\n<div align='center'>{pager}</div>",
            'pager'=>[
                'lastPageLabel'=>'>|',
                'firstPageLabel'=>'|<',
                'maxButtonCount'=>7,

            ],


            'columns'=>[
                ['class' => 'yii\grid\ActionColumn',
                    'template'=>'{view}  {delete}',
                    'buttons'=>

                        ['view'=>function($model, $key, $index){
                            $myurl='index.php?r=client/anketa&clientId='.$key['ID_CL'];
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
                                'title' => Yii::t('app', 'Просмотр'),
                            ]);
                        },
                            'delete'=>function($model, $key, $index){

                                $myurl='index.php?r=client/clientdelete&clientId='.$key['ID_CL'];

                                return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
                                    'title' => Yii::t('app', 'Удалить'),
                                ]);
                            },],

                ],

                    'FAM',
                    'NAME',
                    'OTCH',



                ],


        ]);?>


<!--    --><?php //foreach($clientsPagination as $client): ?>
<!--        <div class="row" style="margin-top: 5px">-->
<!--            <a href=""  data-pjax name="--><?//=$client->ID_CL?><!--" class="clientLink clientRow">-->
<!--            <div class="col-md-2">--><?//=$client->ID_CL?><!--</div>-->
<!--            <div class="col-md-3">--><?//=$client->FAM?><!--</div>-->
<!--            <div class="col-md-3">--><?//=$client->NAME?><!--</div>-->
<!--            <div class="col-md-3">--><?//=$client->OTCH?><!--</div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <hr class="hr">-->
<!--    --><?php //endforeach; ?>
        </div>
    </div>
</div>
<div class="container-fluid col-md-4 clientInfo" style="font-size: 130%;">
    <?php Pjax::begin(['id'=>'selectClientBlock']);?>


    <div class="row justify-content-center" style="font-size: 130%">


        <div class="col-md " align="center">
            <a href="index.php?r=client/anketa&clientId=<?=$selectClient[0]->ID_CL?>"><?=$selectClient[0]->FAM.' '.$selectClient[0]->NAME.' '.$selectClient[0]->OTCH;?></a>
            <?php ?>

        <?php if ($selectClientId==NULL) echo 'Клиент не выбран';?></div>

    </div>
    <div class="row" >
        <table class="table table-striped">
            <thead>
            <tr>

                <th scope="col">Вид животного</th>
                <th scope="col">Кличка</th>

            </tr>
            </thead>
            <tbody>
            <?php if ($selectClient!=NULL) foreach ($selectClient[0]->pacients as $pacient):?>
            <tr>

                <td><?=$pacient->vid->NAMEVID?></td>
                <td><a href="index.php?r=client/visits&pacientId=<?=$pacient->ID_PAC?>"><?=$pacient->KLICHKA?> (<?=$pacient->contract . '-' . date('m-Y', strtotime($pacient->DATE))?>)</a></td>

            </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>

</div>

<?php


$this->registerJs($js2);
?>
<?php Pjax::end();?>


<?php
$js3 = <<<JS
  
    document.getElementById('searchSubmit').click();

JS;
$this->registerJs($js3);
?>