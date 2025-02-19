<?php

namespace App\Console\Commands;

use App\Services\Farm;
use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\FarmAnimals\FarmAnimal;
use App\Services\Production\ProductionType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class FarmLife extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:life {--locale=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Simulate farm life";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Farm $farm)
    {
        $locale = $this->option("locale") ?? "ru";
        App::setLocale($locale);

        $this->addAnimalsToFarm($farm, 10, 20);
        $this->showFarmInfo($farm);

        print(PHP_EOL . str_repeat("-", 50) . PHP_EOL);

        $this->addAnimalsToFarm($farm, 1, 5);
        $this->showFarmInfo($farm);

        return Command::SUCCESS;
    }

    private function showFarmInfo(Farm $farm): void
    {
        $farmAnimals = $farm->getFarmAnimals();
        print(__("farm.animals_by_type_title") . PHP_EOL);
        /**
         * @var FarmAnimal $animal
         */
        $farmAnimals->map(fn($animal) => __($animal->getAnimalTypeName()))
            ->countBy(fn($animalType) => $animalType)
            ->each(fn($animalCount, $animalType) => print(__($animalType) . ": $animalCount" . PHP_EOL));

        $days = 7;
        $productionInfo = $farm->makeProduction($days);

        print(PHP_EOL . __("farm.production_by_period", ["days" => $days]) . PHP_EOL);

        foreach (ProductionType::cases() as $productionType) {
            $productionCount = $productionInfo->getProduction($productionType);
            print(__("farm.production." . strtolower($productionType->name), ["count" => $productionCount]) . PHP_EOL);
        }
    }

    /**
     * Farm animals initialization
     * @param Farm $farm
     * @return void
     */
    private function addAnimalsToFarm(Farm $farm, int $cows, int $chicken): void
    {
        for($i = 0; $i < $cows; $i++) {
            $farm->addAnimal(new Cow());
        }

        for($i = 0; $i < $chicken; $i++) {
            $farm->addAnimal(new Chicken());
        }
    }
}
