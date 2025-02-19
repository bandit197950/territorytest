<?php

namespace App\Services\Production;

use Illuminate\Support\Collection;

/**
 * Stores production by production type.
 *
 * class ProductionInfo
 */
class ProductionInfo
{
    private Collection $productionInfo;

    public function __construct()
    {
        $this->productionInfo = new Collection();
    }

    /**
     * Adding a production.
     * @param ProductionType $productionType
     * @param int $count
     * @return void
     */
    public function addProduction(ProductionType $productionType, int $count): void
    {
        $productionByType = $this->productionInfo->get($productionType->name);
        $this->productionInfo->put($productionType->name, ($productionByType ?? 0) + $count);
    }

    /**
     * Returns production count by production type.
     * @param ProductionType $productionType
     * @return int
     */
    public function getProduction(ProductionType $productionType): int
    {
        return $this->productionInfo->get($productionType->name);
    }
}
