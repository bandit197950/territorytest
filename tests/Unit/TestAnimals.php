<?php

namespace Tests\Unit;

use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\FarmAnimals\Frog;
use Illuminate\Support\Str;
use Tests\TestCase;

class TestAnimals extends TestCase
{
    public function testCow()
    {
        $cow = new Cow();

        $this->assertTrue($cow->getAnimalTypeName() == __("farm.animals.cow"));

        $production = $cow->production();
        $this->assertTrue($production->getName() == __("farm.production.milk"));
        $this->assertTrue($production->getCount() >=8 && $production->getCount() <= 12);

        $uuid = Str::uuid()->toString();
        $cow->setRegistrationNumber($uuid);

        $this->assertTrue($cow->getRegistrationNumber() == $uuid);
    }

    public function testChicken()
    {
        $cow = new Chicken();

        $this->assertTrue($cow->getAnimalTypeName() == __("farm.animals.chicken"));

        $production = $cow->production();
        $this->assertTrue($production->getName() == __("farm.production.eggs"));
        $this->assertTrue($production->getCount() >=0 && $production->getCount() <= 1);

        $uuid = Str::uuid()->toString();
        $cow->setRegistrationNumber($uuid);

        $this->assertTrue($cow->getRegistrationNumber() == $uuid);
    }

    public function testFrog()
    {
        $frog = new Frog();

        $this->assertTrue($frog->getAnimalTypeName() == __("farm.animals.frog"));

        $production = $frog->production();
        $this->assertTrue($production->getName() == __("farm.production.frog_legs"));
        $this->assertTrue($production->getCount() >= 2 && $production->getCount() <= 10);

        $uuid = Str::uuid()->toString();
        $frog->setRegistrationNumber($uuid);

        $this->assertTrue($frog->getRegistrationNumber() == $uuid);
    }
}
