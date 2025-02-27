<?php

namespace App\Services\Production;

use App\Services\FarmAnimals\AnimalProduction;
use Illuminate\Support\Collection;

interface ProductionStorage
{
    /**
     * Empty production storage
     * @return void
     */
    public function empty(): void;

    /**
     * Adding a production.
     * @param AnimalProduction $production
     * @return void
     */
    public function addProduction(AnimalProduction $production): void;

    /**
     * Returns production count by production type.
     * @return Collection
     */
    public function getProduction(): Collection;
}
