<?php
namespace TestTask\Object\Presentation\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use TestTask\Common\PresentersListBuilder;
use TestTask\Object\App\Factories\StudiedObjectFactory;
use TestTask\Object\Infrastructure\Factories\StudiedObjectRepositoryFactory;
use TestTask\Object\Presentation\Presenters\StudiedObjectPresenter;
use TestTask\Object\Presentation\Validators\StudiedObjectControllerValidator;

class StudiedObjectController
{

    public function getStudiedObjectById(Request $request, Response $response): Response
    {
        $id = (int)$request->getAttribute('id');
        StudiedObjectControllerValidator::getStudiedObjectById($id);

        $repository = StudiedObjectRepositoryFactory::create();
        $result = $repository->getStudiedObjectById($id);
        $presenter = new StudiedObjectPresenter($result);

        return $response->withJson($presenter);
    }

    public function getStudiedObjectByIdList(Request $request, Response $response): Response
    {
        $idList = $request->getParsedBodyParam('idList');
        $idList = is_string($idList) ? json_decode($idList, true) : $idList;
        StudiedObjectControllerValidator::getStudiedObjectByIdList($idList);

        $repository = StudiedObjectRepositoryFactory::create();
        $result = $repository->getStudiedObjectByIdList($idList);
        $presenters = PresentersListBuilder::createPresentersFromList($result, StudiedObjectPresenter::class);

        return $response->withJson($presenters);
    }

    public function updateStudiedObject(Request $request, Response $response): Response
    {
        $studiedObjectData = $request->getParsedBody();
        StudiedObjectControllerValidator::updateStudiedObject($studiedObjectData);

        $studiedObject = StudiedObjectFactory::create($studiedObjectData);

        $repository = StudiedObjectRepositoryFactory::create();
        $result = $repository->updateStudiedObject($studiedObject);

        return $response->withJson($result);
    }

    public function createStudiedObject(Request $request, Response $response): Response
    {
        $studiedObjectData = $request->getParsedBody();
        StudiedObjectControllerValidator::createStudiedObject($studiedObjectData);

        $studiedObject = StudiedObjectFactory::create($studiedObjectData);

        $repository = StudiedObjectRepositoryFactory::create();
        $result = $repository->createStudiedObject($studiedObject);

        return $response->withJson($result);
    }

    public function deleteStudiedObject(Request $request, Response $response): Response
    {
        $id = (int)$request->getAttribute('id');
        StudiedObjectControllerValidator::deleteStudiedObject($id);

        $repository = StudiedObjectRepositoryFactory::create();
        $studiedObject = $repository->getStudiedObjectById($id);
        $result = $repository->deleteStudiedObject($studiedObject);

        return $response->withJson($result);
    }
}
