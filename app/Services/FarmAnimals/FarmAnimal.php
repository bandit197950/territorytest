<?php

namespace App\Services\FarmAnimals;

/**
 * Base farm animal class.
 */
abstract class FarmAnimal
{
    private ?string $registrationNumber;

    public function setRegistrationNumber(string $registrationNumber): void
    {
        $this->registrationNumber = $registrationNumber;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    abstract public static function getAnimalTypeName();

    abstract public function production(): AnimalProduction;
}
