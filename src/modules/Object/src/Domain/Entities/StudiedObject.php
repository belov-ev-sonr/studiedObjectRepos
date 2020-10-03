<?php
namespace TestTask\Object\Domain\Entities;

class StudiedObject
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var PositionPoint[] */
    private $positionPoints;

    /** @var int[] */
    private $filesId;

    /**
     * StudiedObject constructor.
     * @param int $id
     * @param string $name
     * @param PositionPoint[] $positionPoints
     */
    public function __construct(int $id, string $name, array $positionPoints)
    {
        $this->id = $id;
        $this->name = $name;
        $this->positionPoints = $positionPoints;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return PositionPoint[]
     */
    public function getPositionPoints(): array
    {
        return $this->positionPoints;
    }

    /**
     * @return int[]
     */
    public function getFilesId(): array
    {
        return $this->filesId;
    }
}
