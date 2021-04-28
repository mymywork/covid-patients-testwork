<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = 'Создать пациента';
$this->params['breadcrumbs'][] = ['label' => 'Пациенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-create">

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
