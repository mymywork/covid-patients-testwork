<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = 'Отредактировать пациента: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пациенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Отредактировать';
?>
<div class="patient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'polyclinics' => $polyclinics,
        'statuses' => $statuses,
        'treatments' => $treatments,
        'formDiseases' => $formDiseases,
		'patients' => $patients,        
    ]) ?>

</div>
