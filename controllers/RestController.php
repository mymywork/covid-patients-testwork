<?php

namespace app\controllers;

use yii\web\Response;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use app\models\User;
use app\models\PatientSearchRest;
use app\models\Patient;
use Yii;

class RestController extends ActiveController
{
	public $modelClass = 'app\models\PatientSearchRest';

	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'items',
	];
 
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}


	public function actions(){

		$actions = parent::actions(); 
		unset($actions['create']);
		unset($actions['index']);
		unset($actions['delete']);
		unset($actions['update']);
		return $actions;
	}
	/**
	 ** @inheritdoc
	 **/
	public function behaviors() {
		$behaviors = parent::behaviors();
		$behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

	//	$behaviors['contentNegotiator']['only'] = ['index','view','create'];
		$behaviors['authenticator'] = [
			'class' => CompositeAuth::className(),
			'authMethods' => [
				[
					'class' => HttpBasicAuth::className(),
					'auth' => function ($username, $password) {
						$user = User::find()->where(['username' => $username])->one();
						if ($user->validatePassword($password)) {
							return $user;
						}
						return null;
					}
				],
				QueryParamAuth::className(),
			],
		];
	
		return $behaviors;
	}

	public function actionUpdate() {
		return ["status" => "not implement"];
	}

	public function actionDelete() {
		return ["status" => "not implement"];
	}

	/**
	 * Lists all Patient models.
	 * @return mixed
	 */
	public function actionIndex()
	{

		$params = Yii::$app->request->get();
		$searchModel = new PatientSearchRest;
		$dataProvider = $searchModel->search($params);

		return $dataProvider;
	}
	/**
	 * Creates a new Patient model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{

		$model = new Patient();

		$user = User::findOne(\Yii::$app->user->id);

		if ($model->load(\Yii::$app->request->post())) {
			$model->created = date("Y-m-d H:i:s");
			$model->updated = date("Y-m-d H:i:s");
			$model->created_by = \Yii::$app->user->id;
			$model->updated_by = \Yii::$app->user->id;
			$model->birthday = $model->birthday  ? date("Y-m-d", strtotime($model->birthday)) : null;

			if (!Yii::$app->user->isSuperadmin) {
				$model->polyclinic_id=$user->polyclinic_id;
			}

			if ($model->save()) {
				//print_r($model);
				return [ "status" => "ok", "patient_id" => $model->id ];
			} else {
				return ["status" => "validate error", "error" => $model->errors ];
			}
		}
		return [ "status" => "request fields load error" ];
	}
}
