<?php

namespace App\Arena;

use App\Fighter\Hero;
use App\Inventory\Shield;
use App\Inventory\Weapon;
use App\Tile\Building;
use App\Tile\Bush;
use App\Tile\Grass;
use App\Tile\Water;

class ArenaAugeas extends Arena
{
    public function __construct()
    {
        $sword = new Weapon(10);
        $shield = new Shield();
        $hero = new Hero('Heracles', 0, 0);
        $hero->setWeapon($sword);
        $hero->setShield($shield);

        $monsters = [];

        $grasses = [
            new Grass(0, 0),
            new Grass(1, 0),
            new Grass(0, 1),
            new Grass(2, 1),
            new Grass(5, 1),
            new Grass(8, 1),
            new Grass(9, 1),
            new Grass(0, 2),
            new Grass(1, 2),
            new Grass(2, 2),
            new Grass(3, 2),
            new Grass(4, 2),
            new Grass(5, 2),
            new Grass(6, 2),
            new Grass(7, 2),
            new Grass(8, 2),
            new Grass(9, 2),
            new Grass(0, 3),
            new Grass(1, 3),
            new Grass(2, 3),
            new Grass(3, 3),
            new Grass(4, 3),
            new Grass(5, 3),
            new Grass(6, 3),
            new Grass(0, 4),
            new Grass(1, 4),
            new Grass(2, 4),
            new Grass(5, 4),
            new Grass(6, 4),
            new Grass(7, 4),
            new Grass(0, 5),
            new Grass(1, 5),
            new Grass(3, 5),
            new Grass(4, 5),
            new Grass(6, 5),
            new Grass(7, 5),
            new Grass(8, 5),
            new Grass(9, 5),
            new Grass(1, 6),
            new Grass(2, 6),
            new Grass(3, 6),
            new Grass(4, 6),
            new Grass(5, 6),
            new Grass(6, 6),
            new Grass(7, 6),
            new Grass(9, 6),
            new Grass(0, 7),
            new Grass(1, 7),
            new Grass(2, 7),
            new Grass(3, 7),
            new Grass(4, 7),
            new Grass(5, 7),
            new Grass(6, 7),
            new Grass(7, 7),
            new Grass(8, 7),
            new Grass(9, 7),
            new Grass(0, 8),
            new Grass(1, 8),
            new Grass(2, 8),
            new Grass(3, 8),
            new Grass(0, 9),
            new Grass(1, 9),
            new Grass(2, 9),
            new Grass(3, 9),
            new Grass(7, 8),
            new Grass(9, 8),
            new Grass(7, 9),
            new Grass(8, 9),
            new Grass(9, 9),
        ];


        $bushes = [
            new Bush(1, 1),
            new Bush(2, 5),
            new Bush(3, 4),
            new Bush(7, 3),
            new Bush(0, 6),
            new Bush(8, 3),
            new Bush(9, 3),
            new Bush(8, 4),
            new Bush(9, 4),
            new Bush(4, 4),
            new Bush(5, 5),
            new Bush(8, 6),
            new Bush(8, 8),
        ];

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

        $buildings = [
            new Building(4, 8),
            new Building(5, 8),
            new Building(6, 8), 
            new Building(4, 9),
            new Building(5, 9),
            new Building(6, 9),
        ];
       
        $tiles = [...$waters, ...$grasses, ...$bushes, ...$buildings];

        parent::__construct($hero, $monsters, $tiles);
    }
}
