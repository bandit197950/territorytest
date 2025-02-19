<?php

namespace App\Services\FarmAnimals;

use App\Services\Production\ProductionType;

/**
 * Cow animal.
 */
class Cow extends FarmAnimal
{
    public function __construct()
    {
        $this->productionType = ProductionType::Milk;
    }

    /**
     * Cow produce  8-12 litres milk per day.
     * @return int
     */
    public function production(): int
    {
        return random_int(8, 12);
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
