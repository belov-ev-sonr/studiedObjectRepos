<?php
namespace TestTask\Common;

use ReflectionClass;

class PresentersListBuilder
{
    public static function createPresentersFromList(array $objectsList, string $presenterClassName): array
    {
        $reflection = new ReflectionClass($presenterClassName);
        $presentersList = [];
        foreach ($objectsList as $object) {
            $presentersList[] = $reflection->newInstance($object);
        }

        return $presentersList;
    }

}
