<?php

namespace App\Services\FarmAnimals;

use App\Services\Production\ProductionType;

/**
 * Cow animal.
 */
class Cow extends FarmAnimal
{
    /**
     * Cow produce  8-12 litres milk per day.
     * @return int
     */
    public function production(): AnimalProduction
    {
        return new AnimalProduction(__("farm.production.milk"), random_int(8, 12));
    }

    /**
     * Return locale dependent animal type name.
     * @return string
     */
    public static function getAnimalTypeName(): string
    {
        return __("farm.animals.cow");
    }

}
