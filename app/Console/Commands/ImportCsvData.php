<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCsvData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-csv-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Service to import data from CSV files';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $importCsvDataService = app('App\Services\ImportCSVData');
        $importCsvDataService->import();
    }
}
