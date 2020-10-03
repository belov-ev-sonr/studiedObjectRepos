<?php
namespace TestTask\UploaderFile\Domain\Interfaces;

use TestTask\UploaderFile\Domain\Entities\File;

interface FileUploaderRepository
{
    public function saveFile(File $file): int;

    public function getFileById(int $id): File;
}
