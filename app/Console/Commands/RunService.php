<?php

namespace App\Console\Commands;

use App\Interfaces\CurrencyRateServiceInterface;
use App\Services\NbpCurrencyRateService;
use Illuminate\Console\Command;

class RunService extends Command
{
    protected CurrencyRateServiceInterface $currencyRateService;

    public function __construct(
        CurrencyRateServiceInterface $currencyRateService,
    ){
        parent::__construct();
        $this->currencyRateService = $currencyRateService;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:getAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import or update full A table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->currencyRateService->importRates();
        return Command::SUCCESS;
    }
}
