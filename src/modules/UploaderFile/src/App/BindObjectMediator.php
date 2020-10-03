<?php
namespace TestTask\UploaderFile\App\Services;

use TestTask\Common\DatabaseAdapters\DatabaseAdapterFactory;
use TestTask\Object\Infrastructure\Repositories\StudiedObjectMysqlRepository;
use TestTask\UploaderFile\Domain\Interfaces\BindFileInStudiedObject;

class BindObjectMediator
{
    public static function getBindFileInObjectService(string $typeObject): BindFileInStudiedObject
    {
        switch ($typeObject) {
            case 'studiedObject':
                $service = new StudiedObjectMysqlRepository(DatabaseAdapterFactory::create());
                break;
            default:
                throw new \Exception('Not found typeObject', 400);
        }

        return $service;
    }
}
