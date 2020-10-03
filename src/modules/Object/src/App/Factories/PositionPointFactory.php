<?php
namespace TestTask\Object\App\Factories;

use TestTask\Object\Domain\Entities\PositionPoint;

class PositionPointFactory
{
    public static function create(array $point): PositionPoint
    {
        $id = (int)$point['id'] ? (int)$point['id'] : 0;
        return new PositionPoint(
            $id,
            (float)$point['x'],
            (float)$point['y']
        );
    }

    /**
     * @param array $pointsListData
     * @return PositionPoint[]
     */
    public static function createFromList(array $pointsListData): array
    {
        $pointsList = [];
        foreach ($pointsListData as $pointData) {
            $pointsList[] = self::create($pointData);
        }

        return $pointsList;
    }
}
