<?php
namespace TestTask\UploaderFile\App\Services;

use Slim\Http\UploadedFile;
use TestTask\UploaderFile\App\Builder\FileBuilder;
use TestTask\UploaderFile\Domain\Entities\File;

class UploaderFile
{
    /** @var string */
    private $filesPath;

    /**
     * UploaderFile constructor.
     */
    public function __construct()
    {
        $this->filesPath = getenv('FILES_PATH');
    }


    /**
     * @param UploadedFile[] $files
     * @return File[]
     */
    public function uploadFile(array $files): array
    {
        $fileBuilder = new FileBuilder();
        $uploadedFiles = [];
        foreach ($files as $fileName => $file) {
            if ($file->getError() === UPLOAD_ERR_OK) {
                $hashFile = $this->getHashFile();
                $path = $this->getMovedPath($file, $hashFile);
                $uploadedFiles[] = $fileBuilder
                                    ->withId(0)
                                    ->withName($file->getClientFilename())
                                    ->withPath($path)
                                    ->withRev(0)
                                    ->withHash($hashFile)
                                    ->build();
            }
        }

        return $uploadedFiles;
    }

    private function getMovedPath(UploadedFile $file, string $hashFile): string
    {
        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        $path = $_SERVER['DOCUMENT_ROOT'] .'/' .$this->filesPath .'/' .$hashFile .'.' .$extension;
        $file->moveTo($path);
        return $path;
    }

    private function getHashFile(): string
    {
        return bin2hex(random_bytes(8));
    }
}
