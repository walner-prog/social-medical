<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;
use Carbon\Carbon;

class DeleteOldActivities extends Command
{
    // El nombre y la firma del comando
    protected $signature = 'activities:delete-old';

    // La descripción del comando
    protected $description = 'Eliminar actividades que tengan más de un mes de antigüedad';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtener las actividades que tienen más de un mes de antigüedad
        $oldActivities = Activity::where('created_at', '<', Carbon::now()->subMonth())->get();

        // Eliminar las actividades
        $oldActivities->each(function ($activity) {
            $activity->delete();
        });

        $this->info('Las actividades antiguas han sido eliminadas.');
    }
}
