<?php
namespace TestTask\Object\Presentation\Presenters;

use TestTask\Object\Domain\Entities\PositionPoint;

class PositionPointPresenter implements \JsonSerializable
{
    /** @var PositionPoint */
    private $positionPoint;

    /**
     * PositionPointPresenter constructor.
     * @param PositionPoint $positionPoint
     */
    public function __construct(PositionPoint $positionPoint)
    {
        $this->positionPoint = $positionPoint;
    }

    /**
     * @return PositionPoint
     */
    public function getPositionPoint(): PositionPoint
    {
        return $this->positionPoint;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'x' => $this->getPositionPoint()->getX(),
            'y' => $this->getPositionPoint()->getY()
        ];
    }
}
