<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use execut\autosizeTextarea\TextareaWidget;
use TextFiller\TextFiller;
?>
<script>
    $(function() {
        $("div[id*='menu-']").hide();
    });

    function toggle(objName) {
        var obj = $(objName),
            blocks = $("div[id*='menu-']");

        if (obj.css("display") != "none") {
            obj.animate({ height: 'hide' }, 500);
        } else {
            var visibleBlocks = $("div[id*='menu-']:visible");

            if (visibleBlocks.length < 1) {
                obj.animate({ height: 'show' }, 500);
            } else {
                $(visibleBlocks).animate({ height: 'hide' }, 500, function() {
                    obj.animate({ height: 'show' }, 500);
                });
            }
        }
    }


</script>

<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-2">
            <span style="font-size: 150%">История болезни: <a href="index.php?r=client/visits&pacientId=<?=$pacient->ID_PAC?>" class="clientLink"><?=$pacient->KLICHKA?></a></span>
        </div>
        <?php if ($_GET['ID_IST']!=NULL):?>
        <div class="col-md-6">
            <? $textFiller->renderButton(); ?>
        </div>

        <?php endif; ?>
    </div>

    <div>
        <?php $form = ActiveForm::begin(['options'=>['id'=>'istbolForm']]) ?>
        <?= $form->field($istbol, 'DIST')->textInput()->label('Дата')?>
    </div>
    <?php

    ?>
    <a href="#" style="width: 100%;text-align: left;margin-top: 10px" onclick="toggle('#menu-anamnez');" class="btn btn-default">Анамнез жизни</a>
    <div id="menu-anamnez" class="pacient-form" style="">

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Вакцинация</th>
            <th scope="col">Обработка от глистов</th>
            <th scope="col">Обработка от блох и клещей</th>
            <th scope="col">Ранее болели</th>
            <th scope="col">Ранее лечили</th>
            <th scope="col">Аллергии</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                <?php
                echo $form->field($istbol, 'VAK')->widget(TextareaWidget::class, [
                    'options' => [
                        'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                    ],
                    'clientOptions' => [
                        'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                        'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                        //Post grow callback. Executes after dimensions of textarea have been adjusted.
                        'flickering' => true, //(true/false) - Enable/Disable flickering.
                        //If flickering is disabled, extra line will be added to textarea.
                        //Flickering is enabled by default.

                    ]
                ])->label(false);?>

            </th>
            <td>
                <?php
                echo $form->field($istbol, 'GLIST')->widget(TextareaWidget::class, [
                    'options' => [
                        'style' => 'height: 100%; width:100%;', // If you want set textarea height
                    ],
                    'clientOptions' => [
                        'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                        'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                        //Post grow callback. Executes after dimensions of textarea have been adjusted.
                        'flickering' => true, //(true/false) - Enable/Disable flickering.
                        //If flickering is disabled, extra line will be added to textarea.
                        //Flickering is enabled by default.

                    ]
                ])->label(false);?>
            </td>
            <td>
                <?php
                echo $form->field($istbol, 'BLOH')->widget(TextareaWidget::class, [
                    'options' => [
                        'style' => 'height: 100%; width:100%;', // If you want set textarea height
                    ],
                    'clientOptions' => [
                        'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                        'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                        //Post grow callback. Executes after dimensions of textarea have been adjusted.
                        'flickering' => true, //(true/false) - Enable/Disable flickering.
                        //If flickering is disabled, extra line will be added to textarea.
                        //Flickering is enabled by default.

                    ]
                ])->label(false);?>
            </td>
            <td>
                <?php
                echo $form->field($istbol, 'BEFORE_SICK')->widget(TextareaWidget::class, [
                    'options' => [
                        'style' => 'height: 100%; width:100%;', // If you want set textarea height
                    ],
                    'clientOptions' => [
                        'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                        'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                        //Post grow callback. Executes after dimensions of textarea have been adjusted.
                        'flickering' => true, //(true/false) - Enable/Disable flickering.
                        //If flickering is disabled, extra line will be added to textarea.
                        //Flickering is enabled by default.

                    ]
                ])->label(false);?>
            </td>
            <td><?php
                echo $form->field($istbol, 'BEFORE_HEAL')->widget(TextareaWidget::class, [
                    'options' => [
                        'style' => 'height: 100%; width:100%;', // If you want set textarea height
                    ],
                    'clientOptions' => [
                        'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                        'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                        //Post grow callback. Executes after dimensions of textarea have been adjusted.
                        'flickering' => true, //(true/false) - Enable/Disable flickering.
                        //If flickering is disabled, extra line will be added to textarea.
                        //Flickering is enabled by default.

                    ]
                ])->label(false);?></td>
            <td><?php
                echo $form->field($istbol, 'ALLERGY')->widget(TextareaWidget::class, [
                    'options' => [
                        'style' => 'height: 100%; width:100%;', // If you want set textarea height
                    ],
                    'clientOptions' => [
                        'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                        'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                        //Post grow callback. Executes after dimensions of textarea have been adjusted.
                        'flickering' => true, //(true/false) - Enable/Disable flickering.
                        //If flickering is disabled, extra line will be added to textarea.
                        //Flickering is enabled by default.

                    ]
                ])->label(false);?></td>
        </tr>

        </tbody>
    </table>
    </div>

<!-------------------------------------------------------Анамнез болезни--------------------------------------------------------------->

    <a href="#" style="width: 100%;text-align: left;margin-top: 10px" onclick="toggle('#menu-anamnez_sick');" class="btn btn-default">Анамнез болезни</a>
    <div id="menu-anamnez_sick" class="pacient-form" style="">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Что беспокоит</th>
                <th scope="col">Начало возникновения симптомов</th>
                <th scope="col">Что предшествовало</th>
                <th scope="col">Чем лечили</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">
                    <?php
                    echo $form->field($istbol, 'COMPLAINTS')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>

                </th>
                <td>
                    <?php
                    echo $form->field($istbol, 'START')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </td>
                <td>
                    <?php
                    echo $form->field($istbol, 'BEFORE')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </td>
                <td>
                    <?php
                    echo $form->field($istbol, 'ABOUT_HEAL')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </td>


            </tr>

            </tbody>
        </table>
    </div>


    <a href="#" style="width: 100%;text-align: left;margin-top: 10px" onclick="toggle('#menu-osmotr');" class="btn btn-default">Клинический осмотр</a>
    <div id="menu-osmotr" class="pacient-form row container-fluid" style="">
        <div class="col-md-6">
        <table class="table table-bordered">

            <tr>
                <th scope="col">Общее состояние</th>
                <th scope="col">
                    <?php
                    echo $form->field($istbol, 'STATE')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>




            </tr>
            <tr>
                <th scope="col">
                    Состояние слизистых
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'SLIZ_STATE')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tr>
                <th scope="col">
                    Состояние шерсти
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'SHERST_STATE')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tr>
                <th scope="col">
                    Наружное ухо
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'UHO')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tr>
                <th scope="col">
                    Исследование брюшной полости
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'POLOST')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tr>
                <th scope="col">
                    ЧСС
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'CHSS')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tr>
                <th scope="col">
                    ЧДД
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'CHDD')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tr>
                <th scope="col">
                    Т
                </th>
                <th>
                    <?php
                    echo $form->field($istbol, 'T')->widget(TextareaWidget::class, [
                        'options' => [
                            'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                        ],
                        'clientOptions' => [
                            'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                            'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                            //Post grow callback. Executes after dimensions of textarea have been adjusted.
                            'flickering' => true, //(true/false) - Enable/Disable flickering.
                            //If flickering is disabled, extra line will be added to textarea.
                            //Flickering is enabled by default.

                        ]
                    ])->label(false);?>
                </th>
            </tr>

            <tbody>



            </tbody>
        </table>
        </div>





        <div class="col-md-6">
            <table class="table table-bordered">

                <tr>
                    <th scope="col">Полож. тела, упитанность</th>
                    <th scope="col">
                        <?php
                        echo $form->field($istbol, 'UPIT')->widget(TextareaWidget::class, [
                            'options' => [
                                'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                            ],
                            'clientOptions' => [
                                'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                                'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                                //Post grow callback. Executes after dimensions of textarea have been adjusted.
                                'flickering' => true, //(true/false) - Enable/Disable flickering.
                                //If flickering is disabled, extra line will be added to textarea.
                                //Flickering is enabled by default.

                            ]
                        ])->label(false);?>
                    </th>




                </tr>
                <tr>
                    <th scope="col">
                        Состояние кожи
                    </th>
                    <th>
                        <?php
                        echo $form->field($istbol, 'SKIN_STATE')->widget(TextareaWidget::class, [
                            'options' => [
                                'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                            ],
                            'clientOptions' => [
                                'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                                'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                                //Post grow callback. Executes after dimensions of textarea have been adjusted.
                                'flickering' => true, //(true/false) - Enable/Disable flickering.
                                //If flickering is disabled, extra line will be added to textarea.
                                //Flickering is enabled by default.

                            ]
                        ])->label(false);?>
                    </th>
                </tr>

                <tr>
                    <th scope="col">
                        Состояние л/у
                    </th>
                    <th>
                        <?php
                        echo $form->field($istbol, 'LU_STATE')->widget(TextareaWidget::class, [
                            'options' => [
                                'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                            ],
                            'clientOptions' => [
                                'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                                'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                                //Post grow callback. Executes after dimensions of textarea have been adjusted.
                                'flickering' => true, //(true/false) - Enable/Disable flickering.
                                //If flickering is disabled, extra line will be added to textarea.
                                //Flickering is enabled by default.

                            ]
                        ])->label(false);?>
                    </th>
                </tr>

                <tr>
                    <th scope="col">
                        Опорно-двигательный аппарат
                    </th>
                    <th>
                        <?php
                        echo $form->field($istbol, 'ODA')->widget(TextareaWidget::class, [
                            'options' => [
                                'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                            ],
                            'clientOptions' => [
                                'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                                'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                                //Post grow callback. Executes after dimensions of textarea have been adjusted.
                                'flickering' => true, //(true/false) - Enable/Disable flickering.
                                //If flickering is disabled, extra line will be added to textarea.
                                //Flickering is enabled by default.

                            ]
                        ])->label(false);?>
                    </th>
                </tr>

                <tr>
                    <th scope="col">
                        Исследование грудной полости
                    </th>
                    <th>
                        <?php
                        echo $form->field($istbol, 'IGD')->widget(TextareaWidget::class, [
                            'options' => [
                                'style' => 'height: 100%; width:100%;font-weight:normal;', // If you want set textarea height
                            ],
                            'clientOptions' => [
                                'vertical' => true, //(true/false) - Enable/Disable vertical autogrow (true by default)
                                'horizontal' => false, //(true/false) - Enable/Disable horizontal autogrow (true by default)

                                //Post grow callback. Executes after dimensions of textarea have been adjusted.
                                'flickering' => true, //(true/false) - Enable/Disable flickering.
                                //If flickering is disabled, extra line will be added to textarea.
                                //Flickering is enabled by default.

                            ]
                        ])->label(false);?>
                    </th>
                </tr>



            </table>
        </div>
    </div>





    <?= $form->field($istbol, 'ID_IST')->textInput(['readonly'=>'readonly', 'style'=>'display:none;'])->label('')?>
    <?= $form->field($istbol, 'ID_PAC')->textInput(['readonly'=>'readonly', 'value'=>$pacient->ID_PAC, 'style'=>'display:none;'])->label('')?>

    <?= $form->field($istbol, 'OBSL')->textarea(['rows'=>10])->label('Данные объективного исследования')?>


    <div class="row">
        <div class="col-md-2"><?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></div>

        <?php if ($_GET['ID_IST']!=NULL):?>
            <div class="col-md-10" style="text-align: right">
                <a href="index.php?r=client/istboldelete&ID_IST=<?=$istbol->ID_IST?>" class="btn btn-danger"  onclick='return confirm("Вы уверены?")'>Удалить</a>
            </div>
        <?php endif;?>
    </div>

    <?php $form = ActiveForm::end();?>
</div>
