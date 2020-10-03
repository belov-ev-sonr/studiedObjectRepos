<?php
namespace TestTask\Object\Infrastructure\Factories;

use TestTask\Common\DatabaseAdapters\DatabaseAdapterFactory;
use TestTask\Object\Domain\Interfaces\StudiedObjectRepository;
use TestTask\Object\Infrastructure\Repositories\StudiedObjectMysqlRepository;


class StudiedObjectRepositoryFactory
{
    public static function create(): StudiedObjectRepository
    {
        $dbAdapter = DatabaseAdapterFactory::create();
        return new StudiedObjectMysqlRepository($dbAdapter);
    }
}
