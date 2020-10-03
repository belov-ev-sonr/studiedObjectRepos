<?php
namespace TestTask\UploaderFile\Presentation\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use TestTask\UploaderFile\App\Services\BindObjectMediator;
use TestTask\UploaderFile\App\Services\UploaderFile;
use TestTask\UploaderFile\Infrastructure\Factories\FileUploaderRepositoryFactory;

class FileController
{
    public function uploadFile(Request $request, Response $response): Response
    {
        $files = $request->getUploadedFiles();
        $typeBindObject = $request->getParsedBodyParam('typeObject');
        $bindObjectId = (int)$request->getParsedBodyParam('bindObjectId');

        $bindObjectService = BindObjectMediator::getBindFileInObjectService($typeBindObject);
        $uploader = new UploaderFile();

        $uploadedFiles = $uploader->uploadFile($files);

        $repository = FileUploaderRepositoryFactory::create();
        foreach ($uploadedFiles as $file) {
            $fileId = $repository->saveFile($file);
            $bindObjectService->bindFileInStudiedObject($fileId, $bindObjectId);
        }

        return $response;
    }
}
