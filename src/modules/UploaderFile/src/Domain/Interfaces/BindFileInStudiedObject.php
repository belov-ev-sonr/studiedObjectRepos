<?php
namespace TestTask\UploaderFile\Domain\Interfaces;

interface BindFileInStudiedObject
{
    public function bindFileInStudiedObject(int $fileId, int $objectId): bool;
}
