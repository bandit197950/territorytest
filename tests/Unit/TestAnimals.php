<?php

namespace Tests\Unit;

use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\Production\ProductionType;
use Illuminate\Support\Str;
use Tests\TestCase;

class TestAnimals extends TestCase
{
    public function testCow()
    {
        $cow = new Cow();

        $this->assertTrue($cow->getAnimalTypeName() == __("farm.animals.cow"));
        $this->assertTrue($cow->getProductionType() == ProductionType::Milk);

        $production = $cow->production();
        $this->assertTrue($production >=8 && $production <= 12);

        $uuid = Str::uuid()->toString();
        $cow->setRegistrationNumber($uuid);

        $this->assertTrue($cow->getRegistrationNumber() == $uuid);
    }

    public function testChicken()
    {
        $cow = new Chicken();

        $this->assertTrue($cow->getAnimalTypeName() == __("farm.animals.chicken"));
        $this->assertTrue($cow->getProductionType() == ProductionType::Eggs);

        $production = $cow->production();
        $this->assertTrue($production >=0 && $production <= 1);

        $uuid = Str::uuid()->toString();
        $cow->setRegistrationNumber($uuid);

        $this->assertTrue($cow->getRegistrationNumber() == $uuid);
    }
}
