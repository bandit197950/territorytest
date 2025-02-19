<?php

namespace App\Services;


use App\Services\FarmAnimals\FarmAnimal;
use App\Services\Production\ProductionInfo;
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

    public function __construct()
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
     * @return ProductionInfo
     */
    public function makeProduction(int $days): ProductionInfo
    {
        $productionInfo = new ProductionInfo();
        $this->farmAnimals->each(function ($animal) use ($days, &$productionInfo) {
            /**
             * @var FarmAnimal $animal
             */
            for ($i = 0; $i < $days; $i++) {
                $productionInfo->addProduction($animal->getProductionType(), $animal->production());
            }
        });

        return $productionInfo;
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
