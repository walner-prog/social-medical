<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Question;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\AuthenticateJWT;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\CategoryController;

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.posts');

  
Route::get('dropzone', [DropzoneController::class, 'index'])->name('dropzone');

Route::post('dropzone/store', [DropzoneController::class, 'store'])->name('dropzone.store');
Route::get('galery/images', [DropzoneController::class, 'galeryImage'])->name('galery');

use App\Http\Controllers\GoogleController;
 
use App\Http\Controllers\FullCalenderController;
   
Route::get('user-notify', [PatientController::class, 'index']);

Route::get('appointmentCalendar', [FullCalenderController::class, 'index'])->name('appointmentCalendar');

Route::controller(FullCalenderController::class)->group(function(){
   
    Route::post('fullcalenderAjax2', 'ajax');
   
});


//Route::post('appointmentCalendar', [FullCalenderController::class, 'store'])->name('store');




Route::post('/logout', function () {
    Auth::logout(); // Cierra la sesión
    return redirect('/'); // Redirige a la página de inicio
})->name('logout');




Route::get('/', function () {
    $users = User::usersPerMonth(); // Obtener los datos
    $specialties = Doctor::select('specialty', DB::raw('count(*) as count'))
    ->groupBy('specialty')
    ->get();

    // Obtener los datos de usuarios por mes
    $usersTimeline = User::select(
        DB::raw("DATE_FORMAT(created_at, '%b %d, %Y') as date"), 
        DB::raw("COUNT(*) as total")
    )
    ->groupBy('date')
    ->orderBy('created_at', 'desc')
    ->take(6)
    ->pluck('total', 'date');

    $doctorsAvatar = Doctor::with('user')->orderBy('created_at')->skip(4)->take(3)->get();

    $totalDoctors = Doctor::count();

    $questions = Question::all();

    return view('welcome', compact('users',
    'specialties',
    'usersTimeline',
    'doctorsAvatar',
    'totalDoctors',
    'questions')); 
    
});


Route::get('/promociones-ofertas', [HomeController::class, 'promociones'])->name('promotions.offers');
Route::get('dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Rutas para GoogleController////

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/doctor/profile/{user}', [GoogleController::class, 'showDoctorProfileForm'])->name('doctor.profile');
Route::post('/doctor/profile/{user}', [GoogleController::class, 'updateDoctorProfile']);
Route::post('/auth/set-role/{user}', [GoogleController::class, 'setRole'])->name('set-role');
Route::get('/auth/select-role/{user}', [GoogleController::class, 'selectRoleForm'])->name('select-role');
Route::post('/assign-role/{user}', [GoogleController::class, 'assignRole'])->name('assign-role');


// Rutas para BlogController////
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

// Rutas para ChatController////
Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

// Rutas para AppointmentController////
Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');






Route::middleware('auth')->group(function () {
    Route::resource('appointments', AppointmentController::class)->except(['destroy']);
});

// Rutas para DoctorController////
Route::get('doctor', [DoctorController::class, 'index'])->name('doctores.index');
Route::get('contacto', [DoctorController::class, 'index'])->name('contacto');
Route::get('/doctor/detalle/{user}', [DoctorController::class, 'show'])->name('doctor.detalle');
Route::get('quienessomos', [BlogController::class, 'QuienesSomos'])->name('quienes.somos');
// En web.php
//Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/blog/edit/{postId}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::get('/posts/{post:slug}', [BlogController::class, 'show'])->name('posts.show');
   // Route::get('/posts/{post:slug}', [BlogController::class, 'show'])->name('posts.show')->middleware(AuthenticateJWT::class);
    Route::get('/blogs/accions', [BlogController::class, 'accionPost'])->name('blogs.accions');
   // Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    //Route::put('/blog/{postId}', [BlogController::class, 'update'])->name('blog.update');
    //Route::delete('/blog/{postId}', [BlogController::class, 'destroy'])->name('blog.destroy');
//});


Route::view('productos', 'productos.index')->name('productos.index');
  
// Rutas para PaymentController////
Route::resource('patient', PatientController::class);
Route::get('citas/program', [PatientController::class, 'showAppointments'])->name('citas.program');

Route::get('citas/programadas', [DoctorController::class, 'showAppointments'])->name('citas.programadas');


/* Rutas para PaymentController////
Route::get('/paypal/create', [PaymentController::class, 'createPayment'])->name('paypal.create');
// Cambiar de GET a POST
Route::post('/paypal/capture', [PaymentController::class, 'capturePayment'])->name('paypal.capture');
Route::post('/paypal-process-order/{order}', [PaymentController::class, 'paypalProcessOrder']);
Route::post('/create-paypal-order', [PaymentController::class, 'createPayPalOrder']);
Route::post('/capture-paypal-order', [PaymentController::class, 'capturePayPalOrder']);

Route::post('/save_subscription', [PaymentController::class, 'store'])->name('subscriptions.store');


Route::get('paypal/create/{amount}', [PaymentController::class, 'create'])->name('paypal.create');
Route::get('paypal/return', [PaymentController::class, 'return'])->name('paypal.return');
Route::get('paypal/cancel', [PaymentController::class, 'cancel'])->name('paypal.cancel');

    
Route::get('/subscription', function () {
    return view('paypal.subscription');
})->name('subscription');

Route::get('/paypal/success', function () {
    return view('paypal.payment-success');
})->name('paypal.success');

Route::get('/paypal/error', function () {
    return view('paypal.payment-error');
})->name('paypal.error');


Route::get('/paypal/cancel', function () {
    return redirect()->route('subscription')->withErrors('Pago cancelado por el usuario.');
})->name('paypal.cancel');



Route::get('/paypal', function () {
    return view('paypal.pay');
})->name('pay');

*/

require __DIR__.'/auth.php';



/*


Route::get('/auth/google', function () {
    
    return Socialite::driver('google')->redirect();
})->name('auth.google');


Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    $token = $googleUser->token;
    $refreshToken = $googleUser->refreshToken;
    $expiresIn = $googleUser->expiresIn;

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
       
        'registered' => true,
    ]);
 
    Auth::login($user);
 
    return redirect('/dashboard');
});
*/