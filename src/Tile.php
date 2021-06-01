<?php

namespace App;

abstract class Tile implements Mappable
{
    protected string $image = '';
    protected bool $isCrossable = true;

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
     * Get the value of isCrossable
     * @return mixed
     */
    public function getIsCrossable(Movable $movable): bool
    {
        return $this->isCrossable;
    }

    /**
     * Set the value of isCrossable
     * @param mixed $isCrossable 
     * @return self
     */
    public function setIsCrossable(bool $isCrossable): self
    {
        $this->isCrossable = $isCrossable;
        return $this;
    }
}