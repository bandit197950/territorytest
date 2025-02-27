<?php

namespace Tests\Unit;

use App\Services\Farm\Farm;
use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\FarmAnimals\FarmAnimal;
use App\Services\FarmAnimals\Frog;
use App\Services\Production\ProductionStorageInMemory;
use Tests\TestCase;

class TestFarm extends TestCase
{
    public function testAddAnimal()
    {
        $farm = new Farm(new ProductionStorageInMemory());
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Chicken());
        $farm->addAnimal(new Chicken());
        $farm->addAnimal(new Frog());

        $farmAnimals = $farm->getFarmAnimals();

        $farmAnimals = $farmAnimals->map(fn($animal) => __($animal->getAnimalTypeName()))
            ->countBy(fn($animalType) => $animalType);

        $this->assertTrue($farmAnimals->get(Cow::getAnimalTypeName()) == 3);
        $this->assertTrue($farmAnimals->get(Chicken::getAnimalTypeName()) == 2);
        $this->assertTrue($farmAnimals->get(Frog::getAnimalTypeName()) == 1);
    }

    public function testProduction()
    {
        $farm = new Farm(new ProductionStorageInMemory());
        $farm->addAnimal(new Cow());
        $farm->addAnimal(new Chicken());
        $farm->addAnimal(new Frog());

        $farm->makeProduction(1);
        $productionStorage = $farm->getProductionStorage();


        $productionStorage->getProduction()->each(function($production) use(&$totalProduction) {
            $totalProduction[$production->getName()] = ($totalProduction[$production->getName()] ?? 0) + $production->getCount();
        });


        $this->assertTrue($totalProduction[__("farm.production.eggs")] >= 0 && $totalProduction[__("farm.production.eggs")] <= 1);
        $this->assertTrue($totalProduction[__("farm.production.milk")] >= 8 && $totalProduction[__("farm.production.milk")] <= 12);
        $this->assertTrue($totalProduction[__("farm.production.frog_legs")] >= 1  && $totalProduction[__("farm.production.frog_legs")] <= 10);
    }

    public function testAnimalAdd()
    {
        $farm = new Farm(new ProductionStorageInMemory());
        $count = 100;
        for($i = 0; $i < $count; $i++) {
            $farm->addAnimal(new Cow());
            $farm->addAnimal(new Chicken());
            $farm->addAnimal(new Frog());
        }

        $farmAnimals = $farm->getFarmAnimals();

        /**
         * @var FarmAnimal $animal
         */
        $this->assertTrue($farmAnimals->map(fn($animal) => $animal->getRegistrationNumber())->unique()->count() == $count*3);
    }

}

