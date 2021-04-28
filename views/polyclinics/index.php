<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поликлиники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polyclinics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить поликлинику', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<?php 

/*use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

echo GhostMenu::widget([
    'encodeLabels'=>false,
    'activateParents'=>true,
    'items' => [
        [
            'label' => 'Backend routes',
            'items'=>UserManagementModule::menuItems()
        ],
        [
            'label' => 'Frontend routes',
            'items'=>[
                ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
            ],
        ],
    ]]);*/
?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update} {delete}'],
        ],
    ]); ?>


</div>
