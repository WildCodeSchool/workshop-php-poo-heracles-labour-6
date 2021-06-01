<?php

namespace App;

interface Movable extends Mappable {
    public function setX(int $x);
    public function setY(int $y);
}