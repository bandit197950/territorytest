<?php

namespace App\Services\FarmAnimals;

use App\Services\Production\ProductionType;

/**
 * Base farm animal class.
 */
abstract class FarmAnimal
{
    private ?string $registrationNumber;

    protected ProductionType $productionType;

    public function setRegistrationNumber(string $registrationNumber): void
    {
        $this->registrationNumber = $registrationNumber;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getProductionType(): ProductionType
    {
        return $this->productionType;
    }

    abstract public static function getAnimalTypeName();

    abstract public function production(): int;
}
