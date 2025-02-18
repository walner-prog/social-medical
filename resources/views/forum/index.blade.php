<x-app-layout>
    <div class="py-24 mx-auto sm:px-6 lg:px-8 dark:bg-gray-900 dark:text-gray-100 overflow-hidden">
       <!-- Título principal -->
    <h1 class="text-2xl font-bold dark:text-white">Foro de Discusión</h1>

    <!-- Listado de Temas -->
    <div>
        @livewire('thread-list') <!-- Componente ThreadList -->
    </div>

    <!-- Detalle del Tema -->
    <div>
        @if(request()->query('thread_id')) <!-- Solo cargar ThreadDetail si se selecciona un tema -->
            @livewire('thread-detail', ['id' => request()->query('thread_id')])
        @endif
    </div>
    </div>

</x-app-layout>





{{-- 


    <div class="bg-white shadow-lg rounded-2xl overflow-hidden flex w-[800px]">
        <!-- Left Section -->
        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Get Started</h2>
            <p class="text-gray-600 mb-4">Welcome to Social Medical - Let’s create your account</p>
            <form action="/register" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="you@example.com" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Sign Up</button>
            </form>
            <p class="text-gray-600 text-sm mt-4 text-center">
                Already have an account? <a href="/login" class="text-blue-500 hover:underline">Log in</a>
            </p>
        </div>

        <!-- Right Section -->
        <div class="w-1/2 bg-gradient-to-b from-blue-500 to-blue-700 flex flex-col items-center justify-center text-white">
            <h3 class="text-3xl font-bold mb-4">Enter the Future of Health, Today</h3>
            <p class="text-center px-8 mb-6">Connect with doctors, share ideas, and manage your health all in one platform.</p>
            <div class="bg-white text-gray-800 rounded-lg p-6 shadow-md w-4/5">
                <p class="text-xl font-bold">Latest Discussions</p>
                <ul class="mt-4 space-y-2">
                    <li class="flex justify-between">
                        <span>Managing Diabetes</span>
                        <span class="text-blue-500">23 posts</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Healthy Eating Tips</span>
                        <span class="text-blue-500">15 posts</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Best Exercises</span>
                        <span class="text-blue-500">10 posts</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>


 <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-900 to-black text-white">
      <div class="container mx-auto p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Left Side: Sign-Up Form -->
        <div class="bg-blue-800/80 p-8 rounded-lg shadow-lg">
          <h2 class="text-2xl font-bold mb-4">Sign Up</h2>
          <p class="mb-6">Startup Account Creation</p>
  
          <form action="#" method="POST" class="space-y-4">
            <div>
              <label for="investor" class="block text-sm font-medium">Are you an Accredited Investor?</label>
              <div class="flex items-center space-x-4 mt-2">
                <label class="inline-flex items-center">
                  <input type="radio" name="investor" value="yes" class="form-radio text-blue-500" />
                  <span class="ml-2">Yes</span>
                </label>
                <label class="inline-flex items-center">
                  <input type="radio" name="investor" value="no" class="form-radio text-blue-500" />
                  <span class="ml-2">No</span>
                </label>
              </div>
            </div>
  
            <div>
              <label for="company" class="block text-sm font-medium">Company Name</label>
              <input type="text" id="company" name="company" class="w-full mt-2 px-4 py-2 rounded bg-blue-700/50 border border-blue-500 focus:outline-none focus:ring focus:ring-blue-300" />
            </div>
  
            <div>
              <label for="address" class="block text-sm font-medium">Address</label>
              <input type="text" id="address" name="address" class="w-full mt-2 px-4 py-2 rounded bg-blue-700/50 border border-blue-500 focus:outline-none focus:ring focus:ring-blue-300" />
            </div>
  
            <div>
              <label for="experience" class="block text-sm font-medium">How many years have you been investing?</label>
              <select id="experience" name="experience" class="w-full mt-2 px-4 py-2 rounded bg-blue-700/50 border border-blue-500 focus:outline-none focus:ring focus:ring-blue-300">
                <option value="1-5">1-5</option>
                <option value="6-10">6-10</option>
                <option value="11+">11+</option>
              </select>
            </div>
  
            <div>
              <label for="comfort" class="block text-sm font-medium">Comfort Level</label>
              <input type="range" id="comfort" name="comfort" min="1" max="10" class="w-full mt-2" />
            </div>
  
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white font-semibold shadow">Next</button>
          </form>
        </div>
  
        <!-- Right Side: Illustration -->
        <div class="flex justify-center items-center">
          <div class="text-center">
            <div class="w-40 h-40 bg-blue-700 rounded-full shadow-lg mb-4 flex items-center justify-center">
              <span class="text-5xl font-bold">3D</span>
            </div>
            <p class="text-xl font-semibold">Welcome to the Future</p>
            <p class="text-sm mt-2 text-gray-300">Seamlessly create your startup account with cutting-edge technology.</p>
          </div>
        </div>
      </div>
      </div>
 </div>

 //////
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Foro de Discusión - Social Medical</h1>

    <!-- Categorías del foro -->
    <div class="mb-6">
        <div class="flex space-x-4 border-b border-gray-300">
            <button class="px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">General</button>
            <button class="px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Preguntas de Pacientes</button>
            <button class="px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Consejos Médicos</button>
            <button class="px-4 py-2 text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Casos Compartidos</button>
        </div>
    </div>

    <!-- Preguntas frecuentes -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Preguntas Frecuentes</h2>
        <div class="divide-y divide-gray-200">
            <!-- Pregunta 1 -->
            <div class="py-4">
                <button class="flex items-center justify-between w-full text-left text-gray-700 font-medium focus:outline-none">
                    <span>¿Cómo puedo registrarme en el foro?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="mt-2 text-gray-600">
                    Para registrarte, haz clic en el botón de registro en la parte superior derecha e ingresa tus datos básicos.
                </div>
            </div>
            <!-- Pregunta 2 -->
            <div class="py-4">
                <button class="flex items-center justify-between w-full text-left text-gray-700 font-medium focus:outline-none">
                    <span>¿Qué temas están permitidos en el foro?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="mt-2 text-gray-600">
                    Se permite cualquier tema relacionado con la salud, consejos médicos, experiencias personales y preguntas generales de pacientes.
                </div>
            </div>
            <!-- Pregunta 3 -->
            <div class="py-4">
                <button class="flex items-center justify-between w-full text-left text-gray-700 font-medium focus:outline-none">
                    <span>¿Cómo reportar contenido inapropiado?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="mt-2 text-gray-600">
                    Para reportar contenido inapropiado, haz clic en el botón "Reportar" junto al mensaje correspondiente.
                </div>
            </div>
        </div>
    </div>
</div>
 //////

--}}