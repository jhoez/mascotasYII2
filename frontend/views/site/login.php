<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="formulario">
	<?=Html::img(Yii::$app->request->baseUrl."/images/logos/logo.png",['class'=>'logofb']) ?>
	<?php $form=ActiveForm::begin([
		'id'=>'logon-form',
	]);?>
	<div class="form-group">
		<div class="col-md-12">
			<?=$form->field($model,'username')->textInput(['autofocus' => true,'class' => 'form-control imput-md']);?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<?=$form->field($model,'password')->passwordInput(['class' => 'form-control imput-md']);?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<?=Html::submitButton('Ingresar',['class'=>'btn btn-primary']);?>
		</div>
	</div>
	<?php $form->end();?>
</div>
