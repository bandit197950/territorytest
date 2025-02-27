<?php

namespace App\Services\FarmAnimals;

class AnimalProduction
{
    public function __construct(private string $name, private int $count)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
