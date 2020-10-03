<?php
namespace TestTask\Object\Domain\Interfaces;

use TestTask\Object\Domain\Entities\StudiedObject;

interface StudiedObjectRepository
{
    public function createStudiedObject(StudiedObject $studiedObject): int;

    public function updateStudiedObject(StudiedObject $studiedObject): bool;

    public function getStudiedObjectById(int $id): StudiedObject;

    public function getStudiedObjectByIdList(array $idList): array;

    public function deleteStudiedObject(StudiedObject $studiedObject): bool;

}
