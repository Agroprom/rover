<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RoverForm extends Model {

    public $x;
    public $y;
    public $heading;
    public $command_line;

    public function rules() {
        return [

            [['x', 'y', 'heading', 'command_line' ],'required'],
            ['command_line', 'string'],           
            [['heading'],'integer','min'=>0, 'max'=>3],
            [['x','y'], 'integer', 'min' => 0, 'max' => 100],
        ];
    }

    public function attributeLabels() {
        return [
            'x' => 'X координата',
            'y' => 'Y координата',
            'heading' => 'Направление',
            'max_x' => 'Размер поля по X',
            'max_y' => 'Размер поля по Y',
            'command_line' => 'Перечень команд',
        ];
    }

}
