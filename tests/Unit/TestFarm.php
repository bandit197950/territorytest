<?php

namespace Tests\Unit;

use App\Services\Farm;
use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\FarmAnimals\FarmAnimal;
use App\Services\Production\ProductionType;
use Tests\TestCase;

class TestFarm extends TestCase
{
    public function testAddAnimal()
    {
        $farm = new Farm();
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Chicken());
        $farm->addAnimal(new Chicken());

        $farmAnimals = $farm->getFarmAnimals();

        $farmAnimals = $farmAnimals->map(fn($animal) => __($animal->getAnimalTypeName()))
            ->countBy(fn($animalType) => $animalType);

        $this->assertTrue($farmAnimals->get(Cow::getAnimalTypeName()) == 3);
        $this->assertTrue($farmAnimals->get(Chicken::getAnimalTypeName()) == 2);
    }

    public function testProduction()
    {
        $farm = new Farm();
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Chicken());

        $productionInfo = $farm->makeProduction(1);

        $eggsCount = $productionInfo->getProduction(ProductionType::Eggs);
        $milkCount = $productionInfo->getProduction(ProductionType::Milk);

        $this->assertTrue($eggsCount >= 0 && $eggsCount <= 1);
        $this->assertTrue($milkCount >= 8 && $milkCount <= 12);
    }

    public function testAnimalAdd()
    {
        $farm = new Farm();
        $count = 100;
        for($i = 0; $i < $count; $i++) {
            $farm->addAnimal(new Cow());
            $farm->addAnimal(new Chicken());
        }

        $farmAnimals = $farm->getFarmAnimals();

        /**
         * @var FarmAnimal $animal
         */
        $this->assertTrue($farmAnimals->map(fn($animal) => $animal->getRegistrationNumber())->unique()->count() == $count*2);
    }

}

