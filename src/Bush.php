<?php

namespace App;

class Bush extends Tile
{
    protected string $image = 'bush.png';
    protected bool $isCrossable = false;
   
    public function getIsCrossable(Movable $movable): bool
    {
        if($movable instanceof Hind) {
            $this->isCrossable = true;
        }

        return $this->isCrossable;
    }

}