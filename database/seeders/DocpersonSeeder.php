<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\User;

class DocpersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Doctor 1: Dr. Luis Pérez, Cardiólogo
        $doctor1 = User::create([
            'name' => 'Dr. Luis Pérez',
            'email' => 'luisperez@example.com',
            'password' => bcrypt('password123'),
            'avatar' => 'https://via.placeholder.com/300', // Avatar placeholder
            'registered' => true,
            'role' => 'doctor',
        ]);

        $doctor1->assignRole('doctor');

        Doctor::create([
            'user_id' => $doctor1->id,
            'specialty' => 'Cardiólogo',
            'city' => 'Managua',
            'experience_years' => 10,
            'bio' => 'El Dr. Luis Pérez es un cardiólogo con más de 10 años de experiencia en el diagnóstico y tratamiento de enfermedades cardíacas. Ha trabajado en diversas instituciones médicas de Nicaragua.',
            'phone' => '+505 2248 7878',
            'email' => 'luisperez@example.com',
            'availability' => json_encode([
                'lunes' => ['start' => '08:00', 'end' => '12:00'],
                'martes' => ['start' => '08:00', 'end' => '12:00'],
                'miércoles' => ['start' => '08:00', 'end' => '12:00'],
                'jueves' => ['start' => '08:00', 'end' => '12:00'],
                'viernes' => ['start' => '08:00', 'end' => '12:00'],
            ]),
            'certifications' => 'Certificado en Cardiología, Universidad Nacional Autónoma de Nicaragua',
            'education' => 'Licenciatura en Medicina, Universidad Nacional Autónoma de Nicaragua',
            'languages' => 'Español, Inglés',
            'average_rating' => 4.8,
            'consultation_hours' => 'Lunes a Viernes de 8:00 AM a 12:00 PM',
        ]);

        // Doctor 2: Dra. Mariana Rodríguez, Pediatra
        $doctor2 = User::create([
            'name' => 'Dra. Mariana Rodríguez',
            'email' => 'marianarodriguez@example.com',
            'password' => bcrypt('password123'),
            'avatar' => 'https://via.placeholder.com/300', // Avatar 
            'registered' => true,
            'role' => 'doctor',
        ]);

        $doctor2->assignRole('doctor');

        Doctor::create([
            'user_id' => $doctor2->id,
            'specialty' => 'Pediatra',
            'city' => 'León',
            'experience_years' => 8,
            'bio' => 'La Dra. Mariana Rodríguez es una pediatra con experiencia en la atención de niños desde su nacimiento hasta la adolescencia. Trabaja en el Hospital Escuela de León.',
            'phone' => '+505 2311 2302',
            'email' => 'marianarodriguez@example.com',
            'availability' => json_encode([
                'lunes' => ['start' => '09:00', 'end' => '13:00'],
                'martes' => ['start' => '09:00', 'end' => '13:00'],
                'miércoles' => ['start' => '09:00', 'end' => '13:00'],
                'jueves' => ['start' => '09:00', 'end' => '13:00'],
                'viernes' => ['start' => '09:00', 'end' => '13:00'],
            ]),
            'certifications' => 'Certificación en Pediatría, Universidad de León',
            'education' => 'Licenciatura en Medicina, Universidad Autónoma de León',
            'languages' => 'Español',
            'average_rating' => 4.7,
            'consultation_hours' => 'Lunes a Viernes de 9:00 AM a 1:00 PM',
        ]);

        // Doctor 3: Dr. Oscar Gómez, Ginecólogo
        $doctor3 = User::create([
            'name' => 'Dr. Oscar Gómez',
            'email' => 'oscargomez@example.com',
            'password' => bcrypt('password123'),
            'avatar' => 'https://via.placeholder.com/300', // Avatar placeholder
            'registered' => true,
            'role' => 'doctor',
        ]);

        $doctor3->assignRole('doctor');

        Doctor::create([
            'user_id' => $doctor3->id,
            'specialty' => 'Ginecólogo',
            'city' => 'Granada',
            'experience_years' => 12,
            'bio' => 'El Dr. Oscar Gómez es un ginecólogo con más de 12 años de experiencia en el cuidado de la salud femenina, ofreciendo atención prenatal, ginecológica y obstétrica.',
            'phone' => '+505 2552 1111',
            'email' => 'oscargomez@example.com',
            'availability' => json_encode([
                'lunes' => ['start' => '10:00', 'end' => '14:00'],
                'martes' => ['start' => '10:00', 'end' => '14:00'],
                'miércoles' => ['start' => '10:00', 'end' => '14:00'],
                'jueves' => ['start' => '10:00', 'end' => '14:00'],
                'viernes' => ['start' => '10:00', 'end' => '14:00'],
            ]),
            'certifications' => 'Certificado en Ginecología, Universidad de Nicaragua',
            'education' => 'Licenciatura en Medicina, Universidad Nacional Autónoma de Nicaragua',
            'languages' => 'Español, Inglés',
            'average_rating' => 4.9,
            'consultation_hours' => 'Lunes a Viernes de 10:00 AM a 2:00 PM',
        ]);
    }
}
