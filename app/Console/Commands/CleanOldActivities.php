<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;
use Carbon\Carbon;

class CleanOldActivities extends Command
{
    protected $signature = 'activities:clean';
    protected $description = 'Elimina actividades antiguas';

    public function handle()
    {
        $dateThreshold = Carbon::now()->subMonths(3); // Retener actividades de los últimos 3 meses
        $deleted = Activity::where('date', '<', $dateThreshold)->delete();
        $this->info("$deleted actividades eliminadas.");
    }
}
