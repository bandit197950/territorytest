<?php

namespace App\Services\Production;

use App\Services\Farm\Farm;
use App\Services\FarmAnimals\FarmAnimal;

/**
 * Show some statistics about farm.
 * ProductionStatistics
 */
class ProductionStatistics
{
    /**
     * Show farm statistics.
     * @param Farm $farm
     * @return void
     */
    public function showStatistics(Farm $farm, int $productionDays): void
    {
        print(PHP_EOL . str_repeat("-", 50) . PHP_EOL);
        $this->showAnimals($farm);
        $this->showProduction($farm, $productionDays);
    }

    /**
     * Show farm `animals` statistics.
     * @param Farm $farm
     * @return void
     */
    private function showAnimals(Farm $farm): void
    {
        print(__("farm.animals_by_type_title") . PHP_EOL);
        $farmAnimals = $farm->getFarmAnimals();
        /**
         * @var FarmAnimal $animal
         */
        $farmAnimals->map(fn($animal) => __($animal->getAnimalTypeName()))
            ->countBy(fn($animalType) => $animalType)
            ->each(fn($animalCount, $animalType) => print(__($animalType) . ": $animalCount" . PHP_EOL));
    }

    /**
     * Show animal production statistics.
     * @param Farm $farm
     * @param int $productionDays
     * @return void
     */
    private function showProduction(Farm $farm, int $productionDays): void
    {
        $productionStorage = $farm->getProductionStorage();
        print(PHP_EOL . __("farm.production_by_period", ["days" => $productionDays]) . PHP_EOL);

        $productionTotals = [];
        $productionList = $productionStorage->getProduction();
        $productionList->each(function($production) use(&$productionTotals) {
            $productionTotals[$production->getName()] = ($productionTotals[$production->getName()] ?? 0) + $production->getCount();
        });

        foreach($productionTotals as $productionName => $productionCount) {
            print("$productionName: $productionCount" . PHP_EOL);
        }
    }

}
