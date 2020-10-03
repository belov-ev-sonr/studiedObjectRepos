<?php
namespace TestTask\Object\Infrastructure\Factories;

use TestTask\Common\DatabaseAdapters\DatabaseAdapterFactory;
use TestTask\Object\Domain\Interfaces\PositionPointRepository;
use TestTask\Object\Infrastructure\Repositories\PositionPointMysqlRepository;

class PositionPointRepositoryFactory
{
    public static function create(): PositionPointRepository
    {
        $dbAdapter = DatabaseAdapterFactory::create();
        return new PositionPointMysqlRepository($dbAdapter);
    }
}
