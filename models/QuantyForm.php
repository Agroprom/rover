<?php

namespace app\models;

use Yii;
use yii\base\Model;

class QuantyForm extends Model {

    public $quanty;
    public $max_y;
    public $max_x;

    public function rules() {
        return [

            [['quanty', 'max_x', 'max_y'], 'required'],
            [['quanty', 'max_x', 'max_y'], 'integer', 'min' => 1, 'max' => 100],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'quanty' => 'Количество луноходов',
            'max_x' => 'Размер поля по Х',
            'max_y' => 'Размер поля по У',
        ];
    }

}
