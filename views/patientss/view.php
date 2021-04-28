<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пациенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="patient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? /*Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone',
            'address',
            [
                'attribute'=>'birthday',
                'value'=>function($model){
                        return $model->birthday ? date("d.m.Y", strtotime($model->birthday)) : null;
                    },
            ],         
            [
                'attribute'=>'polyclinic_id',
                'value'=>function($model){
                        return $model->polyclinic ? $model->polyclinic->name : null;
                    },
            ],
            [
                'attribute'=>'status_id',
                'value'=>function($model){
                        return $model->status ? $model->status->name : null;
                    },
            ],
            [
                'attribute'=>'treatment_id',
                'value'=>function($model){
                        return $model->treatment ? $model->treatment->name : null;
                    },
            ],
            [
                'attribute'=>'form_disease_id',
                'value'=>function($model){
                        return $model->formDisease ? $model->formDisease->name : null;
                    },
            ],
            [
                'attribute'=>'created',
                'value'=>function($model){
                        return $model->createdBy ? $model->createdBy->username . ' '.date("d.m.Y H:i:s", strtotime($model->created))   : null;
                    },
            ],
            [
                'attribute'=>'updated',
                'value'=>function($model){
                        return $model->updatedBy ? $model->updatedBy->username . ' '.date("d.m.Y H:i:s", strtotime($model->updated))   : null;
                    },
            ],
            [
                'attribute'=>'diagnosis_date',
                'value'=>function($model){
                        return $model->diagnosis_date ? date("d.m.Y", strtotime($model->diagnosis_date)) : null;
                    },
            ],
            [
                'attribute'=>'recovery_date',
                'value'=>function($model){
                        return $model->recovery_date ? date("d.m.Y", strtotime($model->recovery_date)) : null;
                    },
            ],
            [
                'attribute'=>'analysis_date',
                'value'=>function($model){
                        return $model->analysis_date ? date("d.m.Y", strtotime($model->analysis_date)) : null;
                    },
            ],
            [
                'attribute'=>'source_id',
                'value'=>function($model){
                        return $model->source ? $model->source->name : null;
                    },
            ],
            [
                'label' => 'Кого заразил',
                'value'=>function($model){
                        $d = [];
                        foreach ($model->patients as $p) {
                            $d[] = $p->name;
                        }
                        return implode(",", $d);
                    },
            ],

        ],
    ]) ?>

</div>
