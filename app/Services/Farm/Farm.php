<?php

namespace App\Services\Farm;


use App\Services\FarmAnimals\FarmAnimal;
use App\Services\Production\ProductionStorage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Farm manages farm animals.
 */
class Farm
{
    /**
     * @var Collection<FarmAnimal> $farmAnimals
     */
    private Collection $farmAnimals;

    public function __construct(private readonly ProductionStorage $productionStorage)
    {
        $this->farmAnimals = new Collection();
    }

    /**
     * Add animal to the Farm.
     * @param FarmAnimal $animal
     * @return void
     */
    public function addAnimal(FarmAnimal $animal): void
    {
        $animal->setRegistrationNumber($this->makeAnimalRegistrationNumber());
        $this->farmAnimals->add($animal);
    }

    /**
     * All farm animals.
     * @return Collection<FarmAnimal>
     */
    public function getFarmAnimals(): Collection
    {
        return $this->farmAnimals;
    }

    /**
     * Make farm production by animals.
     * @param int $days
     * @return void
     */
    public function makeProduction(int $days): void
    {
        $productionStorage = $this->productionStorage;
        $productionStorage->empty();
        $this->farmAnimals->each(function ($animal) use ($days, &$productionStorage) {
            /**
             * @var FarmAnimal $animal
             */
            for ($i = 0; $i < $days; $i++) {
                $productionStorage->addProduction($animal->production());
            }
        });
    }

    /**
     * Returns production storage
     * @return ProductionStorage
     */
    public function getProductionStorage(): ProductionStorage
    {
        return $this->productionStorage;
    }

    /**
     * Make animal unique registration number.
     * @return string
     */
    private function makeAnimalRegistrationNumber(): string
    {
        return Str::uuid()->toString();
    }
}
