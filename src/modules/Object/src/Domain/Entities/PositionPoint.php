<?php
namespace TestTask\Object\Domain\Entities;

class PositionPoint
{
    /** @var int */
    private $id;

    /** @var float */
    private $x;

    /** @var float */
    private $y;

    /**
     * PositionPoint constructor.
     * @param int $id
     * @param float $x
     * @param float $y
     */
    public function __construct(int $id, float $x, float $y)
    {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }
}
