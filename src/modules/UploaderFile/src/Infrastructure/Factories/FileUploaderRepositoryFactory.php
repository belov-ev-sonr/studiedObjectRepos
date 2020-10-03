<?php
namespace TestTask\UploaderFile\Infrastructure\Factories;

use TestTask\Common\DatabaseAdapters\DatabaseAdapterFactory;
use TestTask\UploaderFile\Domain\Interfaces\FileUploaderRepository;
use TestTask\UploaderFile\Infrastructure\Repositories\FileUploaderMysqlRepository;

class FileUploaderRepositoryFactory
{
    public static function create(): FileUploaderRepository
    {
        return new FileUploaderMysqlRepository(DatabaseAdapterFactory::create());
    }
}
