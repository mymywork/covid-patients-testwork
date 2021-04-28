<?php

namespace app\controllers;

use Yii;
use app\models\Patient;
use app\models\User;
use app\models\PatientSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Polyclinics;
use app\models\Statuses;
use app\models\Treatments;
use app\models\FormDiseases;

/**
 * PatientssController implements the CRUD actions for Patient model.
 */
class PatientssController extends BaseController
{

    /**
     * Lists all Patient models.
     * @return mixed
     */
    public function actionIndex()
    {
       /* $dataProvider = new ActiveDataProvider([
            'query' => Patient::find()->with(["status", "polyclinic", "treatment", "formDisease", "updatedBy"])
        ]);*/

        $params = Yii::$app->request->get();
        $searchModel = new PatientSearch;
        $dataProvider = $searchModel->search($params);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            "polyclinics" => Polyclinics::find()->orderBy("name")->all(),
            'searchModel' => $searchModel,
            'statuses' => Statuses::find()->orderBy("sort desc, id asc")->all(),
            'treatments' => Treatments::find()->orderBy("sort desc, id asc")->all(),
            'formDiseases' => FormDiseases::find()->orderBy("sort desc, id asc")->all(),

        ]);
    }

    /**
     * Displays a single Patient model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Patient::find()->where(["id"=>$id])->with(["status", "polyclinic", "treatment", "formDisease", "updatedBy", "createdBy", "source", "patients"])->one();

        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');            
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Patient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patient();

        $user = User::findOne(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            $model->created = date("Y-m-d H:i:s");
            $model->updated = date("Y-m-d H:i:s");
            $model->created_by = \Yii::$app->user->id;
            $model->updated_by = \Yii::$app->user->id;
            $model->birthday = $model->birthday  ? date("Y-m-d", strtotime($model->birthday)) : null;

            if (!Yii::$app->user->isSuperadmin) {
                $model->polyclinic_id=$user->polyclinic_id;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            "polyclinics" => Polyclinics::find()->orderBy("name")->all(),
            'statuses' => Statuses::find()->orderBy("sort desc, id asc")->all(),
            'treatments' => Treatments::find()->orderBy("sort desc, id asc")->all(),
            'formDiseases' => FormDiseases::find()->orderBy("sort desc, id asc")->all(),
            'patients' => Patient::find()->orderBy("name")->all()
        ]);
    }

    /**
     * Updates an existing Patient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne(Yii::$app->user->id);

        if (!Yii::$app->user->isSuperadmin && $model->polyclinic_id!=$user->polyclinic_id) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post())) { 
            $model->updated = date("Y-m-d H:i:s");
            $model->updated_by = \Yii::$app->user->id;

            $model->birthday = $model->birthday  ? date("Y-m-d", strtotime($model->birthday)) : null;
            $model->diagnosis_date = $model->diagnosis_date  ? date("Y-m-d", strtotime($model->diagnosis_date)) : null;
            $model->recovery_date = $model->recovery_date  ? date("Y-m-d", strtotime($model->recovery_date)) : null;
            $model->analysis_date = $model->analysis_date  ? date("Y-m-d", strtotime($model->analysis_date)) : null;

            if (!Yii::$app->user->isSuperadmin) {
                $model->polyclinic_id=$user->polyclinic_id;
            }

            if  ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            "polyclinics" => Polyclinics::find()->orderBy("name")->all(),
            'statuses' => Statuses::find()->orderBy("sort desc, id asc")->all(),
            'treatments' => Treatments::find()->orderBy("sort desc, id asc")->all(),
            'formDiseases' => FormDiseases::find()->orderBy("sort desc, id asc")->all(),
            'patients' => Patient::find()->orderBy("name")->all()
        ]);
    }

    /**
     * Deletes an existing Patient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isSuperadmin) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Patient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
