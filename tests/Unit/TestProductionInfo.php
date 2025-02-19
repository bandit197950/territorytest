<?php

namespace Tests\Unit;

use App\Services\Production\ProductionInfo;
use App\Services\Production\ProductionType;
use Tests\TestCase;

class TestProductionInfo extends TestCase
{
    public function testProductionsAdd()
    {
        $productionInfo = new ProductionInfo();

        $productionInfo->addProduction(ProductionType::Eggs, 1);
        $productionInfo->addProduction(ProductionType::Eggs, 2);
        $productionInfo->addProduction(ProductionType::Milk, 3);
        $productionInfo->addProduction(ProductionType::Milk, 4);

        $this->assertTrue($productionInfo->getProduction(ProductionType::Eggs) == 3);
        $this->assertTrue($productionInfo->getProduction(ProductionType::Milk) == 7);
    }
}
