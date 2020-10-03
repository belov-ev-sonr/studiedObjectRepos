<?php
namespace TestTask\Object\Domain\Interfaces;

use TestTask\Object\Domain\Entities\PositionPoint;

interface PositionPointRepository
{
    public function cratePositionPoint(PositionPoint $point, int $studiedObjectId): int;

    public function deletePositionPoint(PositionPoint $point): bool;

    public function getPositionPointsListByStudiedObjectId(int $studiedObjectId): array;
}
