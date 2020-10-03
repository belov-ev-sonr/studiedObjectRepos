<?php
namespace TestTask\Object\Infrastructure\Repositories;

use TestTask\Common\DatabaseAdapters\DatabaseAdapter;
use TestTask\Object\App\Factories\PositionPointFactory;
use TestTask\Object\Domain\Entities\PositionPoint;
use TestTask\Object\Domain\Interfaces\PositionPointRepository;

class PositionPointMysqlRepository implements PositionPointRepository
{
    /** @var DatabaseAdapter */
    private $adapter;

    /**
     * PositionPointMysqlRepository constructor.
     * @param DatabaseAdapter $adapter
     */
    public function __construct(DatabaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return DatabaseAdapter
     */
    private function getAdapter(): DatabaseAdapter
    {
        return $this->adapter;
    }


    public function cratePositionPoint(PositionPoint $point, int $studiedObjectId): int
    {
        $sql = "
        INSERT INTO `position_points`
        SET `x_point` = '{$point->getX()}',
            `y_point` = '{$point->getY()}'";

        return $this->getAdapter()->insert($sql);
    }

    public function deletePositionPoint(PositionPoint $point): bool
    {
        $sql = "DELETE FROM `position_points`
                WHERE `id` = '{$point->getId()}'";

        return $this->getAdapter()->delete($sql);
    }

    public function getPositionPointsListByStudiedObjectId(int $studiedObjectId): array
    {
        $sql = "SELECT
                  pp.id,
                  pp.x_point `x`,
                  pp.y_point `y`
                FROM position_points pp
                JOIN studied_object_in_position_point soipp ON soipp.position_point_id = pp.id
                WHERE soipp.studied_object_id = '{$studiedObjectId}'";

        $result = $this->getAdapter()->select($sql);

        return PositionPointFactory::createFromList($result);
    }
}
