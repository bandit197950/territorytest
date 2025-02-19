<?php

namespace App\Services\FarmAnimals;

use App\Services\Production\ProductionType;

/**
 * Chicken animal.
 */
class Chicken extends FarmAnimal
{
    public function __construct()
    {
        $this->productionType = ProductionType::Eggs;
    }

    /**
     * Chicken produce 0-1 eggs per day.
     * @return int
     */
    public function production(): int
    {
        return random_int(0, 1);
    }

    /**
     * Return locale dependent animal type name.
     * @return string
     */
    public static function getAnimalTypeName(): string
    {
        return __("farm.animals.chicken");
    }

}
