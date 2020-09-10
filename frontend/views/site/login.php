<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="well">
	<h1>Ingrese al sistema</h1>
	<?php $model=ActiveForm::begin([
		'id'=>'form'
	]);
	?>
	<?=$model->field($form,'username')->textInput(['autofocus' => true]);?>
	<?=$model->field($form,'password')->passwordInput();?>
	<?=Html::submitInput('Ingrese',['class'=>'btn btn-primary']);?>
	<?php $model->end();?>
</div>
