<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%rating}}".
 *
 * @property integer $id
 * @property double $wdbbLimit
 * @property double $deductible
 * @property double $baseRate
 * @property double $creditModification
 * @property double $debitModification
 * @property double $price
 * @property string $created
 * @property string $modified
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rating}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wdbbLimit', 'baseRate', 'creditModification', 'debitModification'], 'required'],
            [['wdbbLimit', 'deductible', 'baseRate', 'creditModification', 'debitModification', 'price'], 'number'],
            [['created', 'modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wdbbLimit' => 'Wdbb Limit',
            'deductible' => 'Deductible',
            'baseRate' => 'Base Rate',
            'creditModification' => 'Credit Modification',
            'debitModification' => 'Debit Modification',
            'price' => 'Price',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * Create new record for Rating table 
     *
     * @param array (POST data)
     * @return int id (if success) / bool false (if failed)
     */
    public function create()
    {
        if($this->validate()) { //Validate data
            if($this->insert() == true) {
                Yii::$app->getSession()->setFlash('success', 'Rating successfully saved!');
                return $this->id;
            } else {
                Yii::$app->getSession()->setFlash('error', 'A problem occured while saving the rating record. Please try again later');
            }
        }

        return false;
    }
}
