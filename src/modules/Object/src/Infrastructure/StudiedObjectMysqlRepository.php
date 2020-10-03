<?php
namespace TestTask\Object\Infrastructure\Repositories;

use TestTask\Common\DatabaseAdapters\DatabaseAdapter;
use TestTask\Object\Domain\Entities\StudiedObject;
use TestTask\Object\Domain\Interfaces\StudiedObjectRepository;
use TestTask\Object\Infrastructure\Factories\PositionPointRepositoryFactory;
use TestTask\UploaderFile\Domain\Interfaces\BindFileInStudiedObject;

class StudiedObjectMysqlRepository implements StudiedObjectRepository, BindFileInStudiedObject
{
    /** @var DatabaseAdapter */
    private $adapter;

    /**
     * StudiedObjectRepository constructor.
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

    public function createStudiedObject(StudiedObject $studiedObject): int
    {
        $sql = "INSERT INTO `studied_objects`
                SET `name` = '{$studiedObject->getName()}'";
        $studiedObjectId = $this->getAdapter()->insert($sql);

        $positionPointRepository = PositionPointRepositoryFactory::create();
        foreach ($studiedObject->getPositionPoints() as $point) {
            $pointId = $positionPointRepository->cratePositionPoint($point, $studiedObjectId);
            $this->insertBindPositionPointInStudiedObject($studiedObjectId, $pointId);
        }

        return $studiedObjectId;
    }

    private function insertBindPositionPointInStudiedObject(int $studiedObjectId, int $pointId): void
    {
        $sql = "INSERT INTO `studied_object_in_position_point`
                SET `studied_object_id` = '{$studiedObjectId}',
                    `position_point_id` = '{$pointId}'";

        $this->getAdapter()->insert($sql);
    }

    public function updateStudiedObject(StudiedObject $studiedObject): bool
    {
        $sql = "UPDATE `studied_objects`
                SET `name` = '{$studiedObject->getName()}'
                WHERE `id` = '{$studiedObject->getId()}'";

        $updateResult = $this->getAdapter()->update($sql);
        if (!$updateResult) {
            throw new \Exception('Can not update studied object');
        }

        $positionPointRepository = PositionPointRepositoryFactory::create();
        $this->deleteBindPositionPointInStudiedObject($studiedObject->getId());
        foreach ($studiedObject->getPositionPoints() as $point) {
            $pointId = $positionPointRepository->cratePositionPoint($point, $studiedObject->getId());
            $this->insertBindPositionPointInStudiedObject($studiedObject->getId(), $pointId);
        }

        return $updateResult;
    }

    private function deleteBindPositionPointInStudiedObject(int $studiedObjectId): void
    {
        $sql = "DELETE FROM `studied_object_in_position_point`
                WHERE `studied_object_id` = '{$studiedObjectId}'";

        $this->getAdapter()->delete($sql);
    }

    public function getStudiedObjectById(int $id): StudiedObject
    {
        $sql = "SELECT
                  `id`,
                  `name`
                FROM `studied_objects`
                WHERE `id` = '{$id}'
                LIMIT 1";
        $studiedObject = $this->getAdapter()->select($sql)[0];

        if (is_null($studiedObject)) {
            throw new \Exception('Not found studied object', 204);
        }

        $positionPointRepository = PositionPointRepositoryFactory::create();
        $pointsList = $positionPointRepository->getPositionPointsListByStudiedObjectId($id);

        return new StudiedObject((int)$studiedObject['id'], $studiedObject['name'], $pointsList);
    }

    public function getStudiedObjectByIdList(array $idList): array
    {
        $sql = "SELECT
                  `id`,
                  `name`
                FROM `studied_objects`
                WHERE `id` IN (" .implode(', ', $idList) .")";
        $studiedObjectsDataList = $this->getAdapter()->select($sql);

        if (!count($studiedObjectsDataList)) {
            throw new \Exception('Not found studied objects', 204);
        }

        $studiedObjectsList = [];
        $positionPointRepository = PositionPointRepositoryFactory::create();
        foreach ($studiedObjectsDataList as $studiedObjectData) {
            $studiedObjectId = (int)$studiedObjectData['id'];
            $pointsList = $positionPointRepository->getPositionPointsListByStudiedObjectId($studiedObjectId);
            $studiedObjectsList[] = new StudiedObject($studiedObjectId, $studiedObjectData['name'], $pointsList);
        }

        return $studiedObjectsList;
    }

    public function deleteStudiedObject(StudiedObject $studiedObject): bool
    {
        $sql = "DELETE FROM `studied_objects`
                WHERE `id` = '{$studiedObject->getId()}'";

        return $this->getAdapter()->delete($sql);
    }

    public function bindFileInStudiedObject(int $fileId, int $objectId): bool
    {
        $sql = "INSERT INTO `studied_object_in_file` 
                SET `studied_object_id` = '{$objectId}',
                    `file_id` = '{$fileId}'";

        return $this->getAdapter()->insert($sql);
    }
}
