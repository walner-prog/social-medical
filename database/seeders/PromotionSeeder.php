<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        // Crea la primera promoción
        Promotion::create([
            'title' => 'Promoción Especial de Invierno',
            'description' => 'Aprovecha un descuento exclusivo para la temporada de invierno.',
            'original_price' => 249,
            'discounted_price' => 199,
            'start_date' => Carbon::now()->subDays(5),  // Empieza hace 5 días
            'end_date' => Carbon::now()->addDays(5),    // Termina en 5 días
        ]);

        // Crea la segunda promoción
        Promotion::create([
            'title' => 'Descuento por Inscripción Temprana',
            'description' => 'Regístrate ahora y obtén un descuento adicional.',
            'original_price' => 300,
            'discounted_price' => 250,
            'start_date' => Carbon::now()->subDays(2),  // Empieza hace 2 días
            'end_date' => Carbon::now()->addDays(10),   // Termina en 10 días
        ]);
    }
}
