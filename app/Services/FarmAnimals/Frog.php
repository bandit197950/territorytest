<?php

namespace App\Services\FarmAnimals;

class Frog extends FarmAnimal
{
    public function production(): AnimalProduction
    {
        return new AnimalProduction(__("farm.production.frog_legs"), random_int(2, 10));
    }

    public static function getAnimalTypeName(): string
    {
        return __("farm.animals.frog");
    }
}
