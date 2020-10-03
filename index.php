<?php

use Dotenv\Dotenv;
use Slim\App;
use TestTask\Common\DBConnect;
use TestTask\Object\Presentation\StudiedObjectRouter;
use TestTask\UploaderFile\Presentation\FileRouter;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/vendor/autoload.php';

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

DBConnect::init();

$config = ['settings' => ['displayErrorDetails' => true]];
$app = new App($config);

$app->group('/studiedObject', function () {
    return new StudiedObjectRouter($this);
});

$app->group('/files', function () {
    return new FileRouter($this);
});

$app->run();
