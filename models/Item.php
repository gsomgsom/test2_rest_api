<?php

namespace app\models;

use Yii;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], RequiredValidator::class],
            ['name', StringValidator::class, 'min' => 1, 'max' => 255],
            ['description', StringValidator::class],
            ['price', NumberValidator::class, 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }
}
