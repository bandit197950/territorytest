<?php

namespace App\Services\Farm;

use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\FarmAnimals\FarmAnimal;
use App\Services\FarmAnimals\Frog;
use App\Services\Production\ProductionStatistics;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class FarmManagement
{
    public function __construct(private readonly Farm $farm, private readonly ProductionStatistics $productionStatistics)
    {
    }

    public function manage(): void
    {
        try {
            $this->addToFarm(20, Cow::class);
            $this->addToFarm(10, Chicken::class);

            $productionDays = 7;
            $this->farm->makeProduction($productionDays);
            $this->productionStatistics->showStatistics($this->farm, $productionDays);

            $this->addToFarm(1, Cow::class);
            $this->addToFarm(5, Chicken::class);

            $this->farm->makeProduction(days: 7);
            $this->productionStatistics->showStatistics($this->farm, $productionDays);

            $this->addToFarm(50, Frog::class);

            $this->farm->makeProduction(days: 7);
            $this->productionStatistics->showStatistics($this->farm, $productionDays);
        } catch(Exception $e) {
            print($e->getMessage());
        }
    }

// TODO: Оставлено для демонстрации, как можно было реализовать иначе добавление
// животных на ферму. Но так мне не понравилось, поэтому реалзиовал через сервис контейнер создание
// нового экземпляра животного.
//    private function addToFarm(int $animalsCount, FarmAnimal $animal): void
//    {
//        for($i = 0; $i < $animalsCount; $i++) $this->farm->addAnimal(clone $animal);
//    }

    /**
     * @throws BindingResolutionException
     */
    private function addToFarm(int $animalsCount, string $animalClass): void
    {
        for($i = 0; $i < $animalsCount; $i++) $this->farm->addAnimal(app()->make($animalClass));
    }

}
