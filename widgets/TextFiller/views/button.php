<?php
namespace TextFiller;

?>

<div class = 'docButton' style="padding-top: 10px;">
    <a href='index.php?r=docs/printdoc&template=<?=$this->params['templateTypeName']?>&id=<?=$this->params['id']?>' id = 'getDoc' class='btn my-btn-dropdown getDoc' style='border-bottom-left-radius: 10px; border-top-left-radius:10px; border-bottom-right-radius: 0px; border-top-right-radius:0px'><?=$this->params['buttonText']?></a>
    <div class='my-dropdown' style="padding-left: 0px;">
        <a class='btn my-btn-dropdown' style='border-left:1px solid navy;border-bottom-left-radius: 0px; border-top-left-radius:0px; border-bottom-right-radius: 10px; border-top-right-radius:10px'>
            <span class='glyphicon glyphicon-list-alt'></span>
        </a>

        <div class="my-dropdown-content docDropdown col-md-6">
            <div class="row hintRow" >
                <div class="col-md-4 hintKey">
                    Тэг
                </div>
                <div class="col-md-8 hintValue">
                    Подставляемое значение
                </div>
            </div>
            <?foreach ($this->params['phrasesHint'] as $key => $hint): ?>
            <div class="row hintRow" >
                <div class="col-md-4 hintKey">
                    <?=$key?>
                </div>
                <div class="col-md-8 hintValue">
                    <?=$hint?>
                </div>
            </div>
            <?endforeach;?>

            <div class="docSelectTemplateForm" style="padding-top: 10px;">
                <a href="/web/index.php?r=docs%2Ftemplatepage" class="btn btn-info">Шаблоны документов</a>
            </div>
        </div>
    </div>
</div>
