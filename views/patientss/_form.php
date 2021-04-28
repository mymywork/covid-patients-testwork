<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="row">

         <div class="col-sm-3">
            <label>Дата рождения</label>
            <?php
            echo DatePicker::widget([
                'name' => 'Patient[birthday]', 
                'value' => $model->birthday ? date('d-M-Y', strtotime($model->birthday)) : '',
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true
                ]
            ]);    
            ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>


        <?php  if (Yii::$app->user->isSuperadmin) : ?>
            <div class="col-sm-4">
                <?= $form->field($model, 'polyclinic_id')
                    ->dropDownList(ArrayHelper::map( $polyclinics, "id", "name")) ?>
            </div>
        <?php endif; ?>
    
    </div>


    <div class="row">
         <div class="col-sm-4">
            <?= $form->field($model, 'status_id')
                ->dropDownList(ArrayHelper::map( $statuses, "id", "name")) ?>
        </div>
         <div class="col-sm-4">
            <?= $form->field($model, 'treatment_id')
                ->dropDownList(ArrayHelper::map( $treatments, "id", "name")) ?>
        </div>
         <div class="col-sm-4">
            <?= $form->field($model, 'form_disease_id')
                ->dropDownList(ArrayHelper::map( $formDiseases, "id", "name")) ?>
        </div>
    </div>


<?php /*
    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> */ ?>

     <div class="row">
        <div class="col-sm-3">
            <label>Дигноз поставлен</label>
            <?php
            echo DatePicker::widget([
                'name' => 'Patient[diagnosis_date]', 
                'value' => $model->diagnosis_date ? date('d-M-Y', strtotime($model->diagnosis_date)) : '',
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd 00:00:00',
                    'todayHighlight' => true
                ]
		    ]);    
		    ?>
        </div>

        <div class="col-sm-3">
            <label>Дата выздоровления</label>
            <?php
            echo DatePicker::widget([
                'name' => 'Patient[recovery_date]', 
                'value' => $model->recovery_date ? date('d-M-Y', strtotime($model->recovery_date)) : '',
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd 00:00:00',
                    'todayHighlight' => true
                ]
            ]);    
            ?>
        </div>

        <div class="col-sm-3">
            <label>Дата анализа</label>
            <?php
            echo DatePicker::widget([
                'name' => 'Patient[analysis_date]', 
                'value' => $model->analysis_date ? date('d-M-Y', strtotime($model->analysis_date)) : '',
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd 00:00:00',
                    'todayHighlight' => true
                ]
            ]);    
            ?>
        </div>
    </div>

     <div class="row" style="margin-top: 20px;">
        <div class="col-sm-6">
            <?php 
            echo $form->field($model, 'source_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map( $patients, "id", "name"),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите пациента'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

