<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            // Generar horarios realistas
            $availability = [
                'monday' => $this->generateWorkingHours(),
                'tuesday' => $this->generateWorkingHours(),
                'wednesday' => $this->generateWorkingHours(),
                'thursday' => $this->generateWorkingHours(),
                'friday' => $this->generateWorkingHours(),
            ];

            Doctor::create([
                'user_id' => $faker->numberBetween(1, 20), // Asegura que el ID esté entre 1 y 20
               // 'name' => $faker->name,
                'specialty' => $faker->word,  // Se puede ajustar según las especialidades reales
                'city' => $faker->city,
                'experience_years' => $faker->numberBetween(1, 40),
                'bio' => $faker->paragraph, // Genera un texto largo para la biografía
                'phone' => $faker->phoneNumber, // Genera un número de teléfono
                'email' => $faker->email, // Genera un correo electrónico
                // Datos de disponibilidad en formato JSON
                'availability' => json_encode($availability),
            ]);
        }
    }

    // Método para generar horas de trabajo realistas
    private function generateWorkingHours()
    {
        $start = '08:00'; // Siempre inicia a las 8:00 AM
        $end = $this->generateRandomTime('14:00', '18:00'); // El fin es aleatorio después de las 9:00 AM

        return [
            'start' => $start,
            'end' => $end,
        ];
    }

    // Método para generar una hora aleatoria dentro de un rango
    private function generateRandomTime($start, $end)
    {
        $startTime = strtotime($start);
        $endTime = strtotime($end);

        // Asegurarse de que el horario esté dentro del rango
        $randomTime = rand($startTime, $endTime);
        return date('H:i', $randomTime);
    }
}
