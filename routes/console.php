<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Console\Commands\VerificarStockBajo;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Este comando puede ser ejecutado manualmente si lo deseas
Artisan::command('verificar:stockbajo', function () {
    $this->call(\App\Console\Commands\VerificarStockBajo::class);
});
