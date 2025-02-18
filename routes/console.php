<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



Artisan::command('activities:cleanup', function () {
    // Elimina las actividades con más de un mes
    DB::table('activities')
        ->where('created_at', '<', Carbon::now()->subMonth())  // un mes 
        //->where('created_at', '<', Carbon::now()->subDays(2))  // dias 
       // ->where('created_at', '<', Carbon::now()->subWeek())  //una semana  // php artisan activities:cleanup
        ->delete();

    $this->info('Actividades antiguas eliminadas.');
})->purpose('Eliminar actividades con más de un mes');




