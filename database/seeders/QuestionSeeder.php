<?php

// database/seeders/QuestionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            ['question' => '¿Qué es Social Medical?', 'answer' => 'Social Medical es una plataforma donde pacientes y doctores pueden interactuar fácilmente.'],
            ['question' => '¿Cómo puedo registrarme?', 'answer' => 'Puedes registrarte usando tu correo electrónico o tus credenciales de redes sociales.'],
            ['question' => '¿Los doctores están verificados?', 'answer' => 'Sí, todos los doctores pasan un proceso de verificación antes de unirse.'],
            ['question' => '¿Cuáles son las especialidades médicas disponibles?', 'answer' => 'Ofrecemos más de 30 especialidades, como pediatría, cardiología, dermatología, entre otras.'],
            ['question' => '¿Puedo buscar doctores por ciudad?', 'answer' => 'Sí, puedes filtrar doctores por ciudad y especialidad.'],
            ['question' => '¿Qué costo tiene el uso de Social Medical?', 'answer' => 'El registro es gratuito. Algunas funciones premium tienen costos adicionales.'],
            ['question' => '¿Puedo contactar directamente a un doctor?', 'answer' => 'Sí, puedes enviarle un mensaje a través de nuestro formulario de contacto.'],
            ['question' => '¿Social Medical tiene una app móvil?', 'answer' => 'Actualmente estamos desarrollando una app para iOS y Android.'],
            ['question' => '¿Cómo funciona el sistema de calificaciones?', 'answer' => 'Los pacientes pueden calificar a los doctores después de una consulta.'],
            ['question' => '¿Es segura mi información personal?', 'answer' => 'Sí, toda tu información está protegida con estándares de seguridad avanzados.'],
        ];

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
