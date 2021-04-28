<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "polyclinics".
 *
 * @property int $id
 * @property string $name
 */
class Polyclinics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'polyclinics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название поликлиники',
        ];
    }
}
