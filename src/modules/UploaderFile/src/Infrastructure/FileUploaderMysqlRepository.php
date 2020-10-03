<?php
namespace TestTask\UploaderFile\Infrastructure\Repositories;

use TestTask\Common\DatabaseAdapters\DatabaseAdapter;
use TestTask\UploaderFile\Domain\Entities\File;
use TestTask\UploaderFile\Domain\Interfaces\FileUploaderRepository;

class FileUploaderMysqlRepository implements FileUploaderRepository
{
    /** @var DatabaseAdapter */
    private $adapter;

    /**
     * FileUploaderMysqlRepository constructor.
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

    public function saveFile(File $file): int
    {
        $sql = "INSERT INTO `files`
                SET `name` = '{$file->getName()}',
                    `path` = '{$file->getPath()}',
                    `rev` = '{$file->getRev()}',
                    `hash` = '{$file->getHash()}'";

        return $this->getAdapter()->insert($sql);
    }

    public function getFileById(int $id): File
    {
        $sql = "SELECT
                  `id`,
                  `name`,
                  `path`,
                  `rev`
                FROM `files`
                WHERE `id` = '{$id}'
                LIMIT 1";
        $fileData = $this->getAdapter()->select($sql);

        return File::fromArray($fileData);
    }
}
