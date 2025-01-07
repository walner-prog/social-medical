<?php
// app/Notifications/AppointmentNotification.php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Appointment;

class AppointmentNotification extends Notification
{
    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        // Puedes usar los canales que necesites (ej. 'mail', 'database', etc.)
        return ['database'];  // Aquí estamos usando solo el canal de base de datos.
    }


    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'patient_name' => $this->appointment->patient->name,
            'appointment_date' => $this->appointment->appointment_date,
            'message' => "You have a new appointment scheduled."
        ];
    }
}
