<?php

use app\models\Client;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use onmotion\apexcharts;
?>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div>
    <?php
    function formatMonth($number){
        $arr = [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Тюнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь'
        ];
        return $arr[$number - 1];
    }

    $seriesAll = [
        [
            'name' => 'Количество новых клиентов',
            'data' => array_column($data, 'total'),
        ],

    ];

    $seriesEmail = [
        [
            'name' => 'Процент новых клиентов с почтой',
            'data' => array_column($data, 'percent'),
        ],

    ];



    ?>
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Выбор года
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="index.php?r=clinic/clinicstats&year=2024">2024</a>
                <a class="dropdown-item" href="index.php?r=clinic/clinicstats&year=2023">2023</a>
                <a class="dropdown-item" href="index.php?r=clinic/clinicstats&year=2022">2022</a>
                <a class="dropdown-item" href="index.php?r=clinic/clinicstats&year=2021">2021</a>
            </div>
        </div>

        <h3>Количество новых клиентов по месяцам, <?=$_GET['year']?> год.</h3>


        <?php echo \onmotion\apexcharts\ApexchartsWidget::widget([
            'type' => 'area', // default area
            //'height' => '350', // default 350

            'chartOptions' => [
                'chart' => [
                    'toolbar' => [
                        'show' => true,
                        'autoSelected' => 'zoom'
                    ],
                ],

                'dataLabels' => [
                    'enabled' => false
                ],

                'stroke' => [
                    'show' => 'true',
                    'curve' => 'straight'
                ],


                'grid' => [
                    'row' => [
                        'colors' => ['#f3f3f3', 'transparent'],
                        'opacity' => 0.5
                    ]
                ],

                'xaxis' => [
                    'categories' => array_map('formatMonth' , array_keys($data))
                ],
                'yaxis' => [
                    //'max' => 100
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'endingShape' => 'rounded'
                    ],
                ],


                'legend' => [
                    'verticalAlign' => 'bottom',
                    'horizontalAlign' => 'left',
                ],
            ],
            'series' => $seriesAll
        ]);
        ?>
    <h3>Доля новых клиентов с заполненной электронной почтой по месяцам, <?=$_GET['year']?> год.</h3>


    <?php echo \onmotion\apexcharts\ApexchartsWidget::widget([
        'type' => 'area', // default area
        //'height' => '350', // default 350

        'chartOptions' => [
            'chart' => [
                'toolbar' => [
                    'show' => true,
                    'autoSelected' => 'zoom'
                ],
            ],

            'dataLabels' => [
                'enabled' => false
            ],

            'stroke' => [
                    'show' => 'true',
                'curve' => 'straight'
            ],


            'grid' => [
                'row' => [
                    'colors' => ['#f3f3f3', 'transparent'],
                    'opacity' => 0.5
                ]
            ],

            'xaxis' => [
                 'categories' => array_map('formatMonth' , array_keys($data))
            ],
            'yaxis' => [
                'max' => 100
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'endingShape' => 'rounded'
                ],
            ],


            'legend' => [
                'verticalAlign' => 'bottom',
                'horizontalAlign' => 'left',
            ],
        ],
        'series' => $seriesEmail
    ]);
    ?>
    </div>
</div>
