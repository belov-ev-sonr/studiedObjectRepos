<?php
namespace TestTask\Object\Presentation\Presenters;

use TestTask\Common\PresentersListBuilder;
use TestTask\Object\Domain\Entities\StudiedObject;

class StudiedObjectPresenter implements \JsonSerializable
{
    /** @var StudiedObject */
    private $studiedObject;

    /**
     * StudiedObjectPresenter constructor.
     * @param StudiedObject $studiedObject
     */
    public function __construct(StudiedObject $studiedObject)
    {
        $this->studiedObject = $studiedObject;
    }

    /**
     * @return StudiedObject
     */
    private function getStudiedObject(): StudiedObject
    {
        return $this->studiedObject;
    }

    public function jsonSerialize()
    {
        $points = $this->getStudiedObject()->getPositionPoints();
        $positionPointsPresentersList = PresentersListBuilder::createPresentersFromList(
            $points,
            PositionPointPresenter::class
        );

        return [
            'id' => $this->studiedObject->getId(),
            'name' => $this->studiedObject->getName(),
            'positionPoints' => $positionPointsPresentersList
        ];
    }


}
