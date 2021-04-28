<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Polyclinics */

$this->title = 'Добавить поликлинику';
$this->params['breadcrumbs'][] = ['label' => 'Поликлиники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polyclinics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
