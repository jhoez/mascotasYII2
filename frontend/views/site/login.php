<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="row clearfix">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
		<div class="well">
			<h2>Inicio de Session</h2>
			<?php $model=ActiveForm::begin([
				'id'=>'form'
			]);?>
			<div class="form-group">
				<?=$model->field($form,'username')->textInput(['autofocus' => true,'class' => 'form-control imput-md']);?>
			</div>
			<div class="form-group">
				<?=$model->field($form,'password')->passwordInput(['class' => 'form-control imput-md']);?>
			</div>
			<div class="form-group">
				<?=Html::submitButton('Ingresar',['class'=>'btn btn-primary']);?>
			</div>
			<?php $model->end();?>
		</div>
	</div>
</div>
