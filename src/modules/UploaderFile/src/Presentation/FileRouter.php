<?php
namespace TestTask\UploaderFile\Presentation;

use Slim\App;
use TestTask\UploaderFile\Presentation\Controller\FileController;

class FileRouter
{

    /**
     * FileRouter constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->post('/upload', [new FileController(), 'uploadFile']);
    }
}
