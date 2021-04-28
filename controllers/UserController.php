<?php

namespace app\controllers;

use webvimark\components\AdminDefaultController;
use Yii;
use app\models\User;
use app\models\Polyclinics;
use webvimark\modules\UserManagement\models\search\UserSearch;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends \webvimark\modules\UserManagement\controllers\UserController
{
	/**
	 * @var User
	 */
	public $modelClass = 'app\models\User';

	/**
	 * @var UserSearch
	 */
	public $modelSearchClass = 'app\models\UserSearch';

	public function actionIndex()
	{
		$searchModel  = $this->modelSearchClass ? new $this->modelSearchClass : null;

		if ( $searchModel )
		{
			$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		}
		else
		{
			$modelClass = $this->modelClass;
			$dataProvider = new ActiveDataProvider([
				'query' => $modelClass::find(),
			]);
		}

		$polyclinics = Polyclinics::find()->orderBy("name")->all();

		return $this->renderIsAjax('index', compact('dataProvider', 'searchModel', 'polyclinics'));
	}



	/**
	 * @return mixed|string|\yii\web\Response
	 */
	public function actionCreate()
	{
		$model = new User(['scenario'=>'newUser']);

		if ( $model->load(Yii::$app->request->post()) && $model->save() )
		{
			User::assignRole($model->id, 'user');
			return $this->redirect(['index']);
		}


		return $this->renderIsAjax('create', [
			'model' => $model, 
			'polyclinics' => Polyclinics::find()->orderBy("name")->all()
		]);
	}

	public function actionDelete($id)
	{
		$model = User::findOne($id);

		if ( !$model )
		{
			throw new NotFoundHttpException('User not found');
		}
		$model->delete();

		$redirect = $this->getRedirectPage('delete', $model);

		return $redirect === false ? '' : $this->redirect(['index']);
	}	

	/**
	 * @param int $id User ID
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string
	 */
	public function actionChangePassword($id)
	{
		$model = User::findOne($id);

		if ( !$model )
		{
			throw new NotFoundHttpException('User not found');
		}

		$model->scenario = 'changePassword';

		if ( $model->load(Yii::$app->request->post()) && $model->save() )
		{
			return $this->redirect(['index']);
		}

		return $this->renderIsAjax('changePassword', compact('model'));
	}

	public function actionUpdate($id)
	{

		$model = User::findOne($id);

		if ( !$model )
		{
			throw new NotFoundHttpException('User not found');
		}

		if ( $this->scenarioOnUpdate )
		{
			$model->scenario = $this->scenarioOnUpdate;
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->save())
		{
			$redirect = $this->getRedirectPage('update', $model);

			return $redirect === false ? '' : $this->redirect(['index']);
		}

		return $this->renderIsAjax('update', [
			'model' => $model, 
			'polyclinics' => Polyclinics::find()->orderBy("name")->all()
		]);
	}




}
