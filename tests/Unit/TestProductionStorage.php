<?php

namespace Tests\Unit;

use App\Services\FarmAnimals\AnimalProduction;
use App\Services\Production\ProductionStorageInMemory;
use Tests\TestCase;

class TestProductionStorage extends TestCase
{
    public function testProductionsAdd()
    {
        $productionStorage = new ProductionStorageInMemory();

        $productionStorage->addProduction(new AnimalProduction(__("farm.production.eggs"), 1));
        $productionStorage->addProduction(new AnimalProduction(__("farm.production.eggs"), 2));
        $productionStorage->addProduction(new AnimalProduction(__("farm.production.milk"), 3));
        $productionStorage->addProduction(new AnimalProduction(__("farm.production.milk"), 4));

        $totalProduction = [];
        $productionStorage->getProduction()->each(function($production) use(&$totalProduction) {
            $totalProduction[$production->getName()] = ($totalProduction[$production->getName()] ?? 0) + $production->getCount();
        });

        $this->assertTrue(array_keys($totalProduction) == [__("farm.production.eggs"), __("farm.production.milk")]);
        $this->assertTrue(array_values($totalProduction) == [3, 7]);
    }
}
