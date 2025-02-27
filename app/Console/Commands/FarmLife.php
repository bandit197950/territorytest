<?php

namespace App\Console\Commands;

use App\Services\AnimalsBuyer;
use App\Services\Farm\Farm;
use App\Services\Farm\FarmManagement;
use App\Services\FarmAnimals\Chicken;
use App\Services\FarmAnimals\Cow;
use App\Services\FarmAnimals\Frog;
use App\Services\Production\ProductionStatistics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class FarmLife extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:life {--locale=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Simulate farm life";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(FarmManagement $farmManagement)
    {
        $locale = $this->option("locale") ?? "ru";
        App::setLocale($locale);

        $farmManagement->manage();

        return Command::SUCCESS;
    }

}
