<?php

namespace App\Services\Production;

use App\Services\FarmAnimals\AnimalProduction;
use Illuminate\Support\Collection;

/**
 * Stores production in memory
 *
 * class ProductionStorage
 */
class ProductionStorageInMemory implements ProductionStorage
{
    private Collection $productionList;

    public function __construct()
    {
        $this->productionList = new Collection();
    }

    /**
     * Adding a production.
     * @param AnimalProduction $production
     * @return void
     */
    public function addProduction(AnimalProduction $production): void
    {
        $this->productionList->add($production);
    }

    /**
     * Returns production
     * @return Collection
     */
    public function getProduction(): Collection
    {
        return $this->productionList;
    }

    public function empty(): void
    {
        $this->productionList = new Collection();
    }
}
