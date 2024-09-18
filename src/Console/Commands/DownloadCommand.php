<?php

namespace Zmap95\VietnamMap\Console\Commands;

use Zmap95\VietnamMap\DownloadFile;
use Zmap95\VietnamMap\Imports\VietnamMapImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class DownloadCommand extends Command
{
    protected $signature = 'vietnam-map:download';

    protected $description = 'Vietnam maps download data';

    public function handle()
    {
        $this->info('Downloading...');

        $this->info('Importing data...');

        $file = app(DownloadFile::class)->saveFile();
        Excel::import(new VietnamMapImport(), $file);
        File::delete($file);
        if (File::isDirectory(storage_path('framework/laravel-excel'))) {
            File::deleteDirectory(storage_path('framework/laravel-excel'));
        }

        $this->info('Completed.');
    }
}
