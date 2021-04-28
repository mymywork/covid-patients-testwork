<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `webvimark\modules\UserManagement\models\User`.
 */
class PatientSearchRest  extends PatientSearch
{

	public function fields() {
	
		return [
			'id',
			'name',
			'birthday',
			'phone',
			'polyclinic_id',
			'status_id',
			'treatment_id',
			'form_disease_id',
			'updated',
			'diagnosis_date',
			'recovery_date'

		];
	}

/*
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}
 */
}
