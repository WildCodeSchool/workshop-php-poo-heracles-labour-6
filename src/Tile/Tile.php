<?php

namespace App\Tile;

use App\Mappable;
use App\Movable;

abstract class Tile implements Mappable
{
    protected string $image = '';
    protected bool $crossable = true;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Get the value of x
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Set the value of x
     */
    public function setX(int $x): self
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Get the value of y
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * Set the value of y
     */
    public function setY(int $y): self
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): string
    {
        return 'assets/images/' . $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get the value of crossable
     * @return mixed
     */
    public function isCrossable(Movable $movable): bool
    {
        return $this->crossable;
    }

    /**
     * Set the value of crossable
     * @param mixed $crossable 
     * @return self
     */
    public function setCrossable(bool $crossable): self
    {
        $this->crossable = $crossable;
        return $this;
    }
}