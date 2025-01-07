<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Cardiología',
            'Dermatología',
            'Endocrinología',
            'Gastroenterología',
            'Ginecología',
            'Neurología',
            'Odontología',
            'Oftalmología',
            'Pediatría',
            'Traumatología',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }
    }
}
