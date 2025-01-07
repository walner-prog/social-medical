<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth; 
use Srmklive\PayPal\Services\PayPal as PayPalClient;



class SubscriptionController extends Controller
{
    public function showPlans() {
        return view('subscriptions.plans');
    }

    public function subscribe(Request $request) {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $accessToken = $provider->getAccessToken();
    
        $orderData = [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $this->getPlanAmount($request->plan),
                    ],
                    "description" => "Subscription for {$request->plan}",
                ]
            ],
        ];
    
        $response = $provider->createOrder($orderData);
    
        if (isset($response['id']) && isset($response['links'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']); // Enlace a PayPal.
                }
            }
        }
    
        return redirect()->route('plans')->with('error', 'No se pudo crear la orden de PayPal.');
    }
    
    public function handleSuccess(Request $request) {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $accessToken = $provider->getAccessToken();
    
        // Intentamos capturar la orden de pago
        $response = $provider->capturePaymentOrder($request->token);
        
        // Inspeccionar la respuesta para ver qué contiene
      //  dd($response); // Puedes usar log::debug() si prefieres loguear la respuesta.
    
        // Verificar si la respuesta tiene un estado "COMPLETED"
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Verificar si el índice 'purchase_units' está presente
            if (isset($response['purchase_units'][0]['amount']['value'])) {
                $user = auth()->user(); // Asegúrate de que el usuario esté autenticado.
                $plan = $response['purchase_units'][0]['description'] ?? 'unknown';
    
                // Activar suscripción
                $user->update([
                    'has_active_subscription' => true,
                    'subscription_expires_at' => now()->addMonth(), // Ajustar según el plan.
                ]);
    
                Subscription::create([
                    'user_id' => $user->id,
                    'plan' => $plan,
                    'amount' => $response['purchase_units'][0]['amount']['value'], // Usamos el 'amount' solo si está presente
                    'start_date' => now(),
                    'end_date' => now()->addMonth(), // Ajustar según el plan.
                ]);
    
                return redirect()->route('dashboard')->with('success', '¡Suscripción activada!');
            } else {
                return redirect()->route('plans')->with('error', 'No se encontró el monto en la respuesta de PayPal.');
            }
        }
    
        return redirect()->route('plans')->with('error', 'Algo salió mal al procesar el pago.');
    }
    
    

    public function handleCancel(Request $request)
{
    // Aquí puedes manejar la cancelación del pago
    // Por ejemplo, puedes redirigir al usuario a una página con un mensaje de error.

    return redirect()->route('plans')->with('error', 'La suscripción fue cancelada.');
}

    

    private function getPlanAmount($plan) {
        switch ($plan) {
            case 'monthly':
                return 5.00;
            case 'semiannual':
                return 50.00;
            case 'annual':
                return 80.00;
            default:
                throw new \Exception('Plan inválido.');
        }
    }
}
