<?php
namespace TestTask\Object\Presentation\Validators;

use TestTask\Common\Exceptions\BadParameterException;

class StudiedObjectControllerValidator
{
    public static function getStudiedObjectById(int $id): void
    {
        if (!$id) {
            throw new BadParameterException('Parameter `Id` can not be empty');
        }
    }

    public static function getStudiedObjectByIdList($idList): void
    {
        if (empty($idList) || !count($idList)) {
            throw new BadParameterException('Parameter `idList` not valid');
        }
    }

    public static function updateStudiedObject(array $studiedObject): void
    {
        if (!(int)$studiedObject['id']) {
            throw new BadParameterException('`Id` can not be empty');
        }

        self::createStudiedObject($studiedObject);
    }

    public static function createStudiedObject(array $studiedObject): void
    {
        $name = (string)$studiedObject['name'];
        if (strlen($name) < 4) {
            throw new BadParameterException('`Name` can be more 4 char');
        }

        $positionPoints = $studiedObject['positionPoints'];
        if (!count($positionPoints)) {
            throw new BadParameterException('`positionPoints` must contain at least 1 element');
        }
    }

    public static function deleteStudiedObject(int $id): void
    {
        if (!$id) {
            throw new BadParameterException('Parameter `Id` can not be empty');
        }
    }
}
