<?php

namespace App\Arena;

use App\Fighter\Hero;
use App\Fighter\Hind;
use App\Inventory\Shield;
use App\Inventory\Weapon;
use App\Tile\Bush;
use App\Tile\Grass;
use App\Tile\Water;

class ArenaAugias extends Arena
{
    public function __construct()
    {
        $hero = new Hero('Heracles', 0, 0);
        $hero->setWeapon(new Weapon(10));
        $hero->setShield(new Shield());

        $monsters = [];

        $grasses = [
            new Grass(0, 0),
            new Grass(1, 0),
            new Grass(0, 1),
            new Grass(1, 1),
            new Grass(2, 1),
            new Grass(5, 1),
            new Grass(8, 1),
            new Grass(9, 1),
            new Grass(0, 8),
            new Grass(1, 8),
            new Grass(2, 8),
            new Grass(3, 8),
            new Grass(0, 9),
            new Grass(1, 9),
            new Grass(2, 9),
            new Grass(3, 9),
            new Grass(6, 8),
            new Grass(7, 8),
            new Grass(8, 8),
            new Grass(9, 8),
            new Grass(6, 9),
            new Grass(7, 9),
            new Grass(8, 9),
            new Grass(9, 9),
        ];
        for($x = 0; $x < $this->getSize() ; $x++) {
            for($y = 2; $y < $this->getSize() -2; $y++) {
                $grasses[] = new Grass($x, $y);
            }
        }

        $waters = [
            new Water(2, 0),
            new Water(3, 0),
            new Water(4, 0),
            new Water(5, 0),
            new Water(6, 0),
            new Water(7, 0),
            new Water(8, 0),
            new Water(9, 0),
            new Water(3, 1),
            new Water(4, 1),
            new Water(6, 1),
            new Water(7, 1),
        ];

        $tiles = [...$waters, ...$grasses];

        parent::__construct($hero, $monsters, $tiles); 
    }
}
