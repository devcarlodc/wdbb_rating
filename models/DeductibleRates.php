<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%deductible_rates}}".
 *
 * @property integer $id
 * @property string $setting
 * @property integer $percentage
 */
class DeductibleRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%deductible_rates}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting', 'percentage'], 'required'],
            [['percentage'], 'integer'],
            [['setting'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'setting' => 'Setting',
            'percentage' => 'Percentage',
        ];
    }


    /**
     * Load the Deductible Percentage Rate for a given WDBB Limit
     *
     * @param decimal/float
     * @return int (percentage rate)
     */
    public static function determineRate($limit)
    {
        if($limit <= 80000) {
            $setting = 'lesser';
        } else {
            $setting = 'greater';
        }

        return DeductibleRates::find()
            ->select('percentage')
            ->where(['setting' => $setting])
            ->one();

    }
}