<?php

use yii\helpers\Html;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

global $uu;
$uu = User::findOne(Yii::$app->user->id);


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пациенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пациента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            'id',
            'name',
            [
                'filter' => false,
                'attribute'=>'birthday',
                'value'=>function($model){
                        return $model->birthday ? date("d.m.Y", strtotime($model->birthday)) : null;
                    },
                'format'=>'raw',
                'label' => 'Д/Р'
            ],
            [
                'attribute'=>'phone',
                'label' => 'Телефон'
            ],
            [
                'filter'=>ArrayHelper::map($polyclinics,'id', 'name'),
                'attribute'=>'polyclinic_id',
                'value'=>function($model){
                        return $model->polyclinic ? $model->polyclinic->name : null;
                    },
            ],
            [
                'filter'=>ArrayHelper::map($statuses,'id', 'name'),
                'attribute'=>'status_id',
                'value'=>function($model){
                        return $model->status ? $model->status->name : null;
                    },
            ],
            [
                'filter'=>ArrayHelper::map($treatments,'id', 'name'),
                'attribute'=>'treatment_id',
                'value'=>function($model){
                        return $model->treatment ? $model->treatment->name : null;
                    },
            ],
            [
                'filter'=>ArrayHelper::map($formDiseases,'id', 'name'),
                'attribute'=>'form_disease_id',
                'value'=>function($model){
                        return $model->formDisease ? $model->formDisease->name : null;
                    },
            ],
            [
                'filter' => false,
                'attribute'=>'updated',
                'value'=>function($model){
                        return $model->updatedBy ? $model->updatedBy->username . ' '.date("d.m.Y", strtotime($model->updated))   : null;
                    },
            ],
            [
                'filter' => false,
                'attribute'=>'diagnosis_date',
                'value'=>function($model){
                        return $model->diagnosis_date ? date("d.m.Y", strtotime($model->diagnosis_date)) : null;
                    },
                'format'=>'raw',
                'label' => 'Диагноз'
            ],
            [
                'filter' => false,
                'attribute'=>'recovery_date',
                'value'=>function($model){
                        return $model->recovery_date ? date("d.m.Y", strtotime($model->recovery_date)) : null;
                    },
                'format'=>'raw',
                'label' => 'Выписан'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' =>
                [
                    'view' =>  true,
                    'update' => function($model) {global $uu; return Yii::$app->user->isSuperadmin || $uu->polyclinic_id==$model->polyclinic_id;},
                    'delete' => Yii::$app->user->isSuperadmin,
                ]                
            ],
        ],
    ]); ?>


</div>
