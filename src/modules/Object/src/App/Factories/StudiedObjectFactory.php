<?php
namespace TestTask\Object\App\Factories;

use TestTask\Object\Domain\Entities\StudiedObject;

class StudiedObjectFactory
{
    public static function create(array $studiedObject): StudiedObject
    {
        $pointsList = PositionPointFactory::createFromList($studiedObject['positionPoints']);

        return new StudiedObject(
            (int)$studiedObject['id'],
            $studiedObject['name'],
            $pointsList
        );

    }
}
