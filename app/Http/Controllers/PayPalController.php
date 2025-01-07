<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Agreement;
use PayPal\Api\Plan;
use PayPal\Api\Payer;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );
    }

    public function createSubscription(Request $request)
{
    // ID del plan que deseas usar
    $planId = 'P-0T288633RE077753RM5SFQHY'; // Usar el ID de plan correspondiente

    // Crear un objeto Agreement (acuerdo de pago)
    $agreement = new Agreement();
    $agreement->setName('Social Medical Subscription')
              ->setDescription('Acceso a servicios avanzados de Social Medical')
              ->setStartDate(now()->addMinutes(10)->toIso8601String()); // Establece la fecha de inicio (mínimo 10 minutos en el futuro)

    // Establecer el Plan de pago
    $plan = new Plan();
    $plan->setId($planId);  // Asignar el ID del plan
    $agreement->setPlan($plan);

    // Establecer el método de pago (PayPal)
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    $agreement->setPayer($payer);

    // Intentar crear el acuerdo de pago
    try {
        // Crea el acuerdo de pago en PayPal
        $agreement->create($this->apiContext);

        // Obtener el link de aprobación (redirección)
        $approvalLink = $agreement->getApprovalLink();

        // Redirige al usuario a PayPal para aprobar el acuerdo
        return redirect($approvalLink); 
    } catch (\Exception $ex) {
        // Manejar el error si ocurre
        return redirect()->route('dashboard')->with('error', 'Error al crear la suscripción: ' . $ex->getMessage());
    }
}
public function success(Request $request)
{
    // Obtener el token de la respuesta de PayPal
    $token = $request->get('token');

    // Verificar que el token exista
    if (empty($token)) {
        return redirect()->route('dashboard')->with('error', 'Token no válido o ausente.');
    }

    // Crear el objeto Agreement utilizando el token
    $agreement = new Agreement();
    $agreement->setToken($token);

    try {
        // Ejecuta el acuerdo con el token obtenido
        // Verifica si el objeto Agreement es válido antes de ejecutar
        if (is_object($agreement) && method_exists($agreement, 'execute')) {
            $agreement->execute($this->apiContext);
        } else {
            throw new \Exception('El objeto Agreement no es válido.');
        }

        // Enviar un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Suscripción completada con éxito.');
    } catch (\Exception $ex) {
        // Capturar el error en caso de que falle la ejecución
        return redirect()->route('dashboard')->with('error', 'Error al completar la suscripción: ' . $ex->getMessage());
    }
}

    public function cancel()
    {
        // Manejo si el usuario cancela la suscripción
        return redirect()->route('dashboard')->with('error', 'Suscripción cancelada.');
    }
}
