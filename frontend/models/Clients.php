<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property integer $age
 * @property string $born
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'age', 'born'], 'required'],
            [['age'], 'integer'],
            [['born'], 'safe'],
            [['name', 'surname'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'age' => 'Age',
            'born' => 'Born',
        ];
    }
}
