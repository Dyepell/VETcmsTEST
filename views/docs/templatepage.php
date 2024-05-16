<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>
<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
		<div class="col-lg-5 clinic-col">
				<h4>Шаблоны документов</h4>
				<?php  if ($docsTemplates != NULL){
						echo GridView::widget([
								'dataProvider' => $docsTemplates,
								'columns'=>[
										['class' => 'yii\grid\ActionColumn',
												'template'=>'{view} {delete}',
												'buttons'=>['view'=>function($model, $key, $index){
														$myurl="index.php?r=docs%2Fdoctemplateform&docTemplateId=".$key['docTemplateId'];
														return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $myurl,[
																'title' => Yii::t('app', 'Просмотр'),
														]);
												},
														'delete'=>function($model, $key, $index){

																$myurl="index.php?r=docs%2Fdoctemplateformdelete&docTemplateId=".$key['docTemplateId'];

																return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 5px;" onclick=\'return confirm("Вы уверены?")\'></span>', $myurl,[
																		'title' => Yii::t('app', 'Удалить'),
																]);
														}
												],

										],
										'docTemplateId',
										'docTemplateTypeId',
										'templateName',
										'isDefault'
								]
						]);
				}
				?>
				<a href="index.php?r=docs%2Fdoctemplateform" class="btn btn-success" style="width: 100%">Добавить шаблон</a>
		</div>
		<div>
				<h4>Типы шаблонов</h4>
		</div>


</div>

