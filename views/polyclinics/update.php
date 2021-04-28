<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Polyclinics */

$this->title = 'Переименовать поликлинику: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Поликлиники', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Переименование';
?>
<div class="polyclinics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
