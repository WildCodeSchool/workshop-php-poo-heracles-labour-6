<?php

namespace App\Tile;

use App\Fighter\Hind;
use App\Movable;

class Bush extends Tile
{
    protected string $image = 'bush.png';
    protected bool $crossable = false;
   
    public function isCrossable(Movable $movable): bool
    {
        if($movable instanceof Hind) {
            return true;
        }

        return $this->crossable;
    }

}