<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Специалисты</h1>
    <a href="index.php?r=client/adddoctor" style="width: 100%;text-align: center;margin-top: 10px;font-size: 150%;" class="btn btn-success">Добавить специалиста</a>
    <?php

    use yii\grid\GridView;

    echo GridView::widget([
        'dataProvider'=>$dataProvider,

        'columns'=>

            [

                ['label' => 'ФИО',
                    'attribute' => 'NAME',

                ],
                ['label' => 'Статус ',
                    'attribute' => 'STATUS_R',
                    'value'=>function($key){
                        if ($key->STATUS_R==1){
                            $status='Работает';
                        }else{
                            $status='Не работает';
                        }
                        return $status;
                    }

                ],


            ],]);?>


</div>
<?php
$js = <<<JS

$('.grid-view tbody tr').on('click', function()
{
    window.location = "index.php?r=client/adddoctor&ID_DOC="+$(this).data('key');
   });
JS;

$this->registerJs($js);?>
