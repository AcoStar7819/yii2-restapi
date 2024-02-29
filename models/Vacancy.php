<?php


namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Vacancy
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $salary
 * @property \DateTime $date_created
 */
class Vacancy extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'description', 'salary'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['name', 'description', 'salary'], 'required', 'on' => self::SCENARIO_CREATE],

            ['name', 'string', 'max' => 255],
            ['salary', 'number', 'min' => 0]
        ];
    }

    public function fields()
    {
        return [
            'name',
            'description',
            'salary'
        ];
    }

    public function extraFields()
    {
        return [
            'id',
            'date_created'
        ];
    }
}