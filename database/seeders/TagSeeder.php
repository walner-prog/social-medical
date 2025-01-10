<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tags = [
            'Cardiología',
            'Diabetes',
            'Salud Mental',
            'Nutrición',
           // 'Cáncer',
            'Pediatría',
           // 'Geriatría',
            'Medicina General',
            'Cirugía',
            'Vacunación',
            'Enfermedades Respiratorias',
            'Rehabilitación',
            'Fisioterapia',
            'Dermatología',
            'Oftalmología',
            'Ginecología',
            'Urología',
            'Neurología',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}

