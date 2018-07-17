<?php

namespace app\models;

/**
 * @property int $x;
 */
class Rover {

    protected $x;
    protected $y;
    /*
     * Хединг задаёт направление. 0- юг, 1-восток, 2-север, 3- запад.
     */
    protected $heading;
    protected $stones;

    /*
     * $max_x, $max_y размеры поля
     */
    protected static $max_x;
    protected static $max_y;
    /*
     * Задаём массив возможных команд лунохода
     */
    protected static $commands = [
        'L' => 'rotateLeft',
        'R' => 'rotateRight',
        'M' => 'move',
        'G' => 'gatherStone',
    ];

    public function __construct($x = 0, $y = 0, $heading = 0) {

        $this->heading = $heading;
        $this->x = $x;
        $this->y = $y;
        $this->stones = 0;
        $this->checkBounds();
    }

    public static function setBounds($max_x, $max_y) {
        self::$max_x = $max_x;
        self::$max_y = $max_y;
    }

    /*
     * Получаем строку команд, затем если команда существует выполняем её
     */

    public function executeCommand($command_line) {
        $commandsArr = str_split($command_line);
        foreach ($commandsArr as $command) {
            if (array_key_exists($command, self::$commands)) {
                $method = self::$commands["$command"];
                $this->$method();
            }
        }
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    public function getStones() {
        return $this->stones;
    }

    public function getHeading() {
        while ($this->heading < 0) {
            $this->heading += 4;
        }
        switch ($this->heading % 4) {
            case 0: return 'Юг';
            case 1: return 'Восток';
            case 2: return 'Север';
            case 3: return 'Запад';
            default: return 'Произошла ошибка, направление не ясно';
        }
    }

    protected function move() {
        while ($this->heading < 0) {
            $this->heading += 4;
        }
        switch ($this->heading % 4) {
            case 0: $this->y -= 1;
                break;
            case 1: $this->x += 1;
                break;
            case 2: $this->y += 1;
                break;
            case 3: $this->x -= 1;
                break;
        }

        $this->checkBounds();
    }

    protected function rotateLeft() {
        $this->heading += 1;
    }

    protected function rotateRight() {
        $this->heading -= 1;
    }

    protected function gatherStone() {
        $this->stones += 1;
    }

    protected function checkBounds() {
        if ($this->x < 0) {
            $this->x = 0;
        }
        if ($this->x > self::$max_x) {
            $this->x = self::$max_x;
        }
        if ($this->y < 0) {
            $this->y = 0;
        }
        if ($this->y > self::$max_y) {
            $this->y = self::$max_y;
        }
    }

}
