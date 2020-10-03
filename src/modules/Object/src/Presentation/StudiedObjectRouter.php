<?php
namespace TestTask\Object\Presentation;

use Slim\App;
use TestTask\Object\Presentation\Controllers\StudiedObjectController;

class StudiedObjectRouter
{

    /**
     * StudiedObjectRouter constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->get('/{id}',       [new StudiedObjectController(), 'getStudiedObjectById']);
        $app->post('/byList',   [new StudiedObjectController(), 'getStudiedObjectByIdList']);
        $app->put('/edit',      [new StudiedObjectController(), 'updateStudiedObject']);
        $app->post('/create',   [new StudiedObjectController(), 'createStudiedObject']);
        $app->delete('/{id}',    [new StudiedObjectController(), 'deleteStudiedObject']);
    }
}
