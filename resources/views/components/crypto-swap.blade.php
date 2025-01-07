<!-- resources/views/components/crypto-swap.blade.php -->
<div class="relative max-w-md mx-auto p-6 rounded-lg shadow-xl bg-gradient-to-b from-indigo-900 to-blue-800">
    <!-- Top Currency Selector -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-2">
            <div class="text-green-400 text-xl animate-bounce">
                <!-- Tether Icon -->
                <x-icons.tether />
            </div>
            <span class="text-white font-bold text-lg">Tether</span>
        </div>
        <input 
            type="number" 
            value="200" 
            class="w-24 p-2 text-right text-white bg-transparent border-b border-gray-500 focus:outline-none focus:border-green-400 transition duration-300">
    </div>

    <!-- Swap Icon -->
    <div class="flex justify-center my-4">
        <button 
            class="p-2 bg-indigo-700 rounded-full text-white hover:rotate-180 transition-transform duration-300">
            <x-icons.swap />
        </button>
    </div>

    <!-- Bottom Currency Selector -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <div class="text-yellow-400 text-xl animate-pulse">
                <!-- Bitcoin Icon -->
                <x-icons.bitcoin />
            </div>
            <span class="text-white font-bold text-lg">Bitcoin</span>
        </div>
        <input 
            type="text" 
            value="0.0020050" 
            class="w-24 p-2 text-right text-white bg-transparent border-b border-gray-500 focus:outline-none focus:border-yellow-400 transition duration-300">
    </div>

    <!-- Conversion Rate -->
    <div class="mt-4 text-center text-gray-400 text-sm">
        1BTC ≈ 97441.4868USDT
    </div>

    <!-- Swap Button -->
    <div class="mt-6 flex justify-center">
        <button 
            class="px-6 py-2 bg-blue-700 rounded-full text-white hover:bg-blue-600 active:scale-95 focus:outline-none transition duration-300">
            Swap
        </button>
    </div>
</div>


<div class="bg-gray-800 rounded-lg p-4">
    <div class="flex justify-between items-center mb-4">
        <div>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Market</button>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Limit</button>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">P2P</button>
        </div>
        <div class="flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0V6m0 0l-4-4m4 4l4-4" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0V6m0 0l-4-4m4 4l4-4" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0V6m0 0l-4-4m4 4l4-4" />
            </svg>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <span class="text-white font-bold">You pay</span>
            <div class="flex items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    </svg>
                <span class="text-white font-bold">ETH</span>
                <input type="number" class="ml-2 border border-gray-700 bg-gray-900 text-white rounded px-2 py-1" value="145.04">
                <span class="text-sm text-gray-400">+0.0012 ETH - $3.67 ⓘ</span>
            </div>
        </div>
        <div>
            <span class="text-white font-bold">Balance: 145.04 ETH</span>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">HALF</button>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">MAX</button>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <span class="text-white font-bold">You receive</span>
            <div class="flex items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    </svg>
                <span class="text-white font-bold">ETH</span>
                <input type="number" class="ml-2 border border-gray-700 bg-gray-900 text-white rounded px-2 py-1" value="145.0388">
                <span class="text-sm text-gray-400">+305.02 POINTS</span>
            </div>
        </div>
        <div>
            <span class="text-white font-bold">ETA: 2 sec</span>
            <div class="flex items-center">
                <span class="text-white font-bold">1 ETH</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    </svg>
                <span class="text-white font-bold">1 ETH</span>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <input type="checkbox" class="mr-2">
            <span class="text-white font-bold">Trade and send to another address</span>
        </div>
        <div>
            <span class="text-white font-bold">Routing</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                </svg>
        </div>
    </div>

    <div class="flex items-center mb-4">
        <span class="text-white font-bold">Enter Optimism address</span>
        <input type="text" class="ml-2 border border-gray-700 bg-gray-900 text-white rounded px-2 py-1" placeholder="Type/Paste or Connect recipient address">
        <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Connect</button>
    </div>

    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">Confirm trade</button>
</div>


<div class="bg-gray-800 rounded-lg p-4 grid-cols-6">
    <!-- Navegación entre opciones -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Perfil Médico</button>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Citas</button>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Consultas</button>
        </div>
        <div class="flex space-x-2">
            <!-- Opciones de configuración -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0V6m0 0l-4-4m4 4l4-4" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0V6m0 0l-4-4m4 4l4-4" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m0 0V6m0 0l-4-4m4 4l4-4" />
            </svg>
        </div>
    </div>

    <!-- Información del Médico -->
    <div class="mb-4">
        <h2 class="text-white font-bold text-xl">Dr. Juan Pérez</h2>
        <p class="text-gray-400">Especialidad: Cardiología</p>
        <p class="text-gray-400">Experiencia: 10 años</p>
        <p class="text-gray-400">Ciudad: Managua, Nicaragua</p>
    </div>

    <!-- Información para el Paciente -->
    <div class="mb-4">
        <h2 class="text-white font-bold text-xl">Información del Paciente</h2>
        <p class="text-gray-400">Nombre: Ana López</p>
        <p class="text-gray-400">Seguro Médico: INSS Básico</p>
        <textarea
            class="w-full bg-gray-900 text-white rounded p-2 mt-2"
            placeholder="Notas sobre el historial médico..."
        ></textarea>
    </div>

    <!-- Opciones de Pago -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <span class="text-white font-bold">Usted paga</span>
            <div class="flex items-center mt-2">
                <span class="text-white font-bold">ETH</span>
                <input
                    type="number"
                    class="ml-2 border border-gray-700 bg-gray-900 text-white rounded px-2 py-1"
                    value="0.05"
                >
                <span class="text-sm text-gray-400">Costo de la consulta: $80</span>
            </div>
        </div>
        <div>
            <span class="text-white font-bold">Balance disponible: 0.50 ETH</span>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">HALF</button>
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">MAX</button>
        </div>
    </div>

    <!-- Confirmar Consulta -->
    <div class="flex items-center mb-4">
        <span class="text-white font-bold">Enviar mensaje al médico</span>
        <textarea
            class="w-full bg-gray-900 text-white rounded p-2 mt-2"
            placeholder="Escriba un mensaje breve..."
        ></textarea>
    </div>

    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
        Confirmar Consulta
    </button>
</div>


<div class="grid grid-cols-2 gap-4">
    <div class="bg-white shadow-md rounded px-4 py-6 text-center">
        <h2 class="text-2xl font-bold mb-2">Total Clientes</h2>
        <p class="text-gray-700 text-lg transition-all duration-300 ease-in-out hover:bg-gray-100">320</p>
        <div class="flex justify-center space-x-4 mt-4">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-green-500 mr-2"></div>
                <p>Activos: 120</p>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full bg-yellow-500 mr-2"></div>
                <p>Leads: 200</p>
            </div>
        </div>
    </div>

    </div>


    <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl mx-auto">
        <!-- Left Section -->
        <div class="bg-gray-100 p-6 w-full md:w-1/3">
            <div class="space-y-6">
                <div>
                    <h2 class="font-semibold text-lg text-gray-900">Untitled UI</h2>
                </div>
                <div>
                    <p class="text-gray-700 text-sm font-medium">Chat to sales</p>
                    <a href="mailto:sales@untitledui.com" class="text-blue-600 hover:underline text-sm">sales@untitledui.com</a>
                    <p class="text-gray-700 text-sm mt-2">Interested in switching? Speak to our team.</p>
                </div>
                <div>
                    <p class="text-gray-700 text-sm font-medium">Email support</p>
                    <a href="mailto:support@untitledui.com" class="text-blue-600 hover:underline text-sm">support@untitledui.com</a>
                    <p class="text-gray-700 text-sm mt-2">We'll get back to you within 24 hours.</p>
                </div>
                <div>
                    <p class="text-gray-700 text-sm font-medium">Chat support</p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">Start live chat</a>
                    <span class="ml-2 text-green-500 text-xs font-medium">Online</span>
                    <p class="text-gray-700 text-sm mt-2">Chat to our staff 24/7 for instant support.</p>
                </div>
                <div>
                    <p class="text-gray-700 text-sm font-medium">Call us</p>
                    <p class="text-gray-700 text-sm">Mon - Fri, 9:00 AM - 5:00 PM (UTC +10:00)</p>
                    <p class="text-blue-600 hover:underline text-sm">1300 132 642</p>
                    <p class="text-blue-600 hover:underline text-sm">+61 402 020 024</p>
                </div>
            </div>
        </div>
    
        <!-- Right Section -->
        <div class="bg-white p-6 w-full md:w-2/3">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Can you tell us about your company?</h3>
            <p class="text-gray-700 text-sm mb-6">We've worked with small startups and Fortune 500 companies.</p>
            <div class="space-y-4">
                <p class="text-gray-700 text-sm font-medium mb-2">What kind of company are you?</p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach (['Tech Startup', 'Software Agency', 'Design Agency', 'Freelancer', 'Solopreneur', 'eCommerce Business', 'Consulting Firm', 'VC Firm', 'University', 'Tech Enterprise', 'Pre-Seed Startup', 'Legal Business'] as $option)
                        <button class="py-2 px-4 bg-gray-100 text-gray-800 text-sm rounded-lg hover:bg-gray-200">{{ $option }}</button>
                    @endforeach
                </div>
            </div>
            <div class="mt-6">
                <p class="text-gray-700 text-sm font-medium mb-2">How large is your company?</p>
                <div class="flex items-center space-x-4">
                    <input type="range" min="1" max="100" value="10" class="w-full">
                    <span class="text-gray-700 text-sm">1-10 people</span>
                </div>
            </div>
            <div class="mt-6 flex space-x-4">
                <button class="py-2 px-6 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200">Go back</button>
                <button class="py-2 px-6 bg-black text-white rounded-lg hover:bg-gray-800">Continue</button>
            </div>
        </div>
    </div>
    

    <div class="bg-white border rounded-lg shadow-md max-w-4xl mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Monetization</h2>
        <p class="text-gray-700 text-sm mb-6">Select service from the listing</p>
    
        <!-- Service Card -->
        <div class="bg-gray-50 border rounded-lg p-4 mb-4">
            <div class="flex items-start space-x-4">
                <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.5-4.5M19.5 10.5L15 6m-9 12h.01M21 12a9 9 0 11-9-9m3 12v.01" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-lg text-gray-900">I'll send you a video message</h3>
                    <p class="text-gray-700 text-sm">Send a video message</p>
                </div>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex justify-between">
                    <p class="text-gray-700 text-sm">Price</p>
                    <p class="text-gray-900 text-sm">$45.00</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700 text-sm">18% Urban Service Fee</p>
                    <p class="text-gray-900 text-sm">$8.10</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700 text-sm">You Will Receive <span class="text-gray-500 text-xs">The estimated amount you will get</span></p>
                    <p class="text-gray-900 text-sm">$36.90</p>
                </div>
            </div>
            <div class="mt-4 flex justify-end space-x-4">
                <button class="py-2 px-4 border rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                <button class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Add</button>
            </div>
        </div>
    
        <!-- Additional Service -->
        <div class="bg-gray-50 border rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-green-100 text-green-600 p-2 rounded-full">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h7m-7 4h3m5-9l2.5-2.5M3 6h6m8 14h1a2 2 0 002-2V9a2 2 0 00-2-2h-1m-5 14v-8m0-5h.01" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg text-gray-900">I'll Follow you on social media</h3>
                        <p class="text-gray-700 text-sm">Follow a user & send screenshot</p>
                    </div>
                </div>
                <button class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18l6-6-6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <br>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-900 text-white">
        <!-- Growth Card -->
        <div class="bg-gradient-to-r from-green-600 via-green-500 to-green-400 rounded-lg p-6 shadow-lg relative">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Growth</h3>
                <button class="text-gray-300 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
            </div>
            <div class="text-5xl font-bold flex items-center space-x-2">
                <span>34%</span>
                <span class="text-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 3l4.5 4.5-1.414 1.414L14 7.828V21h-2V7.828l-2.086 2.086L8.5 7.5 13 3z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <!-- Chart -->
                <svg class="w-full h-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 30" preserveAspectRatio="none">
                    <polyline fill="none" stroke="white" stroke-width="2" points="0,20 20,15 40,10 60,12 80,18 100,8" />
                    <polyline fill="none" stroke="rgba(255, 255, 255, 0.5)" stroke-width="2" stroke-dasharray="4" points="60,12 80,18 100,8" />
                </svg>
                <div class="flex justify-between text-sm mt-2 text-gray-300">
                    <span>Sun</span>
                    <span>Mon</span>
                    <span>Tue</span>
                    <span>Wed</span>
                    <span>Thu</span>
                    <span>Fri</span>
                    <span>Sat</span>
                </div>
            </div>
        </div>
    
        <!-- Revenue Card -->
        <div class="bg-gradient-to-r from-green-400 via-green-300 to-yellow-300 rounded-lg p-6 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Revenue</h3>
                <button class="text-gray-600 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
            </div>
            <div class="text-4xl font-bold">$435,756</div>
            <div class="flex items-center text-red-600 text-sm mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18l6-6-6-6m0 12l-6-6 6-6" />
                </svg>
                <span class="ml-1">16%</span>
            </div>
        </div>
    
        <!-- Total Users Card -->
        <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Total Users</h3>
                <button class="text-gray-600 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
            </div>
            <div class="text-4xl font-bold">93,656</div>
            <div class="flex items-center text-green-300 text-sm mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 3l4.5 4.5-1.414 1.414L14 7.828V21h-2V7.828l-2.086 2.086L8.5 7.5 13 3z" />
                </svg>
                <span class="ml-1">346</span>
            </div>
        </div>
    </div>
<br>
<div class="min-h-screen bg-gray-900 flex items-center justify-center">
<div class="flex space-x-6">
<!-- Tarjeta 1 -->
<div class="bg-gradient-to-br from-teal-500 to-green-400 rounded-xl p-6 shadow-lg w-64">
<div class="text-white text-sm font-semibold">05 / 22</div>
<div class="mt-4 text-white text-lg font-bold">Balance</div>
<div class="mt-2 text-white text-4xl font-extrabold">23,890</div>
<div class="mt-4 flex justify-between items-center text-white text-sm">
    <span>**** 3667</span>
    <button class="bg-white text-gray-800 px-2 py-1 rounded-full">...</button>
</div>
</div>

<!-- Tarjeta 2 -->
<div class="bg-gradient-to-br from-yellow-400 to-orange-300 rounded-xl p-6 shadow-lg w-64">
<div class="text-gray-800 text-sm font-semibold">Total Views</div>
<div class="mt-4 text-gray-800 text-4xl font-extrabold">332,456</div>
<div class="mt-2 text-gray-800 text-sm font-semibold">+7% <span class="text-green-600">▲</span></div>
<div class="mt-4 text-gray-800 text-sm">Growth Last Week</div>
</div>
</div>

<!-- Texto lateral -->
<div class="ml-10 text-white">
<div class="mb-10">
<h2 class="text-4xl font-bold">Up to <span class="text-teal-400">10%</span></h2>
<p class="text-lg">Discount on Crypto</p>
<ul class="mt-4 text-sm">
    <li>Bank Account</li>
    <li>Credit Cards</li>
    <li>Crypto / Coin</li>
</ul>
</div>
<div>
<h2 class="text-4xl font-bold">Up to <span class="text-yellow-400">30%</span></h2>
<p class="text-lg">Growth on Business</p>
<ul class="mt-4 text-sm">
    <li>Easy to Link Account</li>
    <li>Simple Tracking</li>
    <li>24/7 Support</li>
</ul>
</div>
</div>
</div>

<br>
<div class="min-h-screen bg-gray-800 flex items-center justify-center p-6">
<div class="grid grid-cols-2 gap-6">
<!-- Tarjeta de Growth -->
<div class="bg-gradient-to-br from-green-500 via-blue-700 to-black rounded-2xl p-6 shadow-lg w-full">
<div class="flex justify-between items-center text-white">
    <h2 class="text-lg font-semibold">Growth</h2>
    <button class="bg-gray-700 text-white px-2 py-1 rounded-full text-sm">This week</button>
</div>
<div class="mt-6 text-white">
    <h1 class="text-5xl font-bold">34% <span class="text-green-400">▲</span></h1>
</div>
<div class="mt-6">
    <svg class="w-full h-24" viewBox="0 0 400 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 80 C50 60, 100 100, 150 50 C200 0, 250 100, 300 70 C350 40, 400 90, 450 50" stroke="#00FF00" stroke-width="2" fill="none" />
        <path d="M300 70 C350 40, 400 90, 450 50" stroke="#FFFFFF" stroke-dasharray="4 4" stroke-width="2" fill="none" />
    </svg>
</div>
<div class="flex justify-between text-gray-400 text-sm mt-4">
    <span>Sun</span>
    <span>Mon</span>
    <span>Tue</span>
    <span>Wed</span>
    <span>Thu</span>
    <span>Fri</span>
    <span>Sat</span>
</div>
</div>

<!-- Tarjeta de Revenue -->
<div class="bg-gradient-to-br from-green-400 to-yellow-300 rounded-2xl p-6 shadow-lg w-full">
<div class="flex justify-between items-center text-gray-800">
    <h2 class="text-lg font-semibold">Revenue</h2>
    <button class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-sm">...</button>
</div>
<div class="mt-6 text-gray-800">
    <h1 class="text-5xl font-bold">$435,756</h1>
    <p class="text-red-500 text-sm mt-2">▼ 16%</p>
</div>
</div>

<!-- Tarjeta de Total Users -->
<div class="bg-black rounded-2xl p-6 shadow-lg w-full">
<div class="flex justify-between items-center text-white">
    <h2 class="text-lg font-semibold">Total Users</h2>
    <button class="bg-gray-700 text-white px-2 py-1 rounded-full text-sm">...</button>
</div>
<div class="mt-6 text-white">
    <h1 class="text-5xl font-bold">93,656</h1>
    <p class="text-green-400 text-sm mt-2">▲ 346</p>
</div>
</div>
</div>
</div>

<br>
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
<div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-3xl">
<!-- Título -->
<h1 class="text-2xl font-bold text-gray-900">Monetization</h1>
<p class="text-gray-600 mt-2">Select service from the listing</p>

<!-- Tarjeta principal -->
<div class="mt-6 border border-gray-200 rounded-lg p-4">
<div class="flex items-center">
    <!-- Icono -->
    <div class="bg-yellow-500 text-white rounded-full p-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A2 2 0 0119 5.618V5a2 2 0 00-2-2H7a2 2 0 00-2 2v.618a2 2 0 01-.553 1.106L9 10m6 0v10m0-10L9 10m6 0l4.553-2.276M9 10L4.447 7.724M9 10v10m0-10L4.447 7.724M9 20h6" />
        </svg>
    </div>
    <!-- Descripción -->
    <div class="ml-4">
        <h2 class="text-lg font-semibold text-gray-900">I'll send you a video message</h2>
        <p class="text-gray-600 text-sm">Send a video message</p>
    </div>
</div>

<!-- Detalles -->
<div class="mt-4">
    <div class="flex justify-between text-gray-700">
        <span>Price</span>
        <span>$ 45.00</span>
    </div>
    <div class="flex justify-between text-gray-700 mt-2">
        <span>18% Urban Service Fee</span>
        <span>$ 8.10</span>
    </div>
    <div class="flex justify-between text-gray-900 font-semibold mt-2">
        <span>You Will Receive</span>
        <span>$ 36.90</span>
    </div>
</div>

<!-- Botones -->
<div class="mt-6 flex justify-end space-x-4">
    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Cancel</button>
    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Add</button>
</div>
</div>

<!-- Tarjeta flotante -->
<div class="relative mt-6">
<div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-12 bg-white shadow-lg rounded-lg p-4 w-80 animate-float">
    <div class="flex items-center justify-between">
        <!-- Icono -->
        <div class="flex items-center">
            <div class="bg-yellow-500 text-white rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A2 2 0 0119 5.618V5a2 2 0 00-2-2H7a2 2 0 00-2 2v.618a2 2 0 01-.553 1.106L9 10m6 0v10m0-10L9 10m6 0l4.553-2.276M9 10L4.447 7.724M9 10v10m0-10L4.447 7.724M9 20h6" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-semibold text-gray-900">Video message from me</h3>
                <p class="text-gray-600 text-xs">$ 20.00</p>
            </div>
        </div>
        <!-- Botón -->
        <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded-lg hover:bg-gray-300 transition">Edit</button>
    </div>
</div>
</div>

<!-- Tarjeta secundaria -->
<div class="mt-6 border border-gray-200 rounded-lg p-4 flex items-center justify-between">
<div class="flex items-center">
    <!-- Icono -->
    <div class="bg-green-500 text-white rounded-full p-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <!-- Descripción -->
    <div class="ml-4">
        <h2 class="text-lg font-semibold text-gray-900">I'll Follow you on social media</h2>
        <p class="text-gray-600 text-sm">Follow a user & send screenshot</p>
    </div>
</div>
<button class="text-gray-600 hover:text-gray-900 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
</button>
</div>
</div>
</div>
 
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-3xl">
        <!-- Título -->
        <h1 class="text-2xl font-bold text-gray-900">Gestión de Consultas</h1>
        <p class="text-gray-600 mt-2">Organiza y reserva consultas con facilidad</p>

        <!-- Tarjeta de Consulta -->
        <div class="mt-6 border border-gray-200 rounded-lg p-4">
            <div class="flex items-center">
                <!-- Icono -->
                <div class="bg-blue-500 text-white rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A2 2 0 0119 5.618V5a2 2 0 00-2-2H7a2 2 0 00-2 2v.618a2 2 0 01-.553 1.106L9 10m6 0v10m0-10L9 10m6 0l4.553-2.276M9 10L4.447 7.724M9 10v10m0-10L4.447 7.724M9 20h6" />
                    </svg>
                </div>
                <!-- Descripción -->
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-900">Agendar Consulta</h2>
                    <p class="text-gray-600 text-sm">Consulta virtual o presencial</p>
                </div>
            </div>

            <!-- Detalles -->
            <div class="mt-4">
                <div class="flex justify-between text-gray-700">
                    <span>Precio</span>
                    <span>$ 50.00</span>
                </div>
                <div class="flex justify-between text-gray-700 mt-2">
                    <span>Comisión de la Plataforma</span>
                    <span>$ 5.00</span>
                </div>
                <div class="flex justify-between text-gray-900 font-semibold mt-2">
                    <span>Total a Recibir</span>
                    <span>$ 45.00</span>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-4">
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Cancelar</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Reservar</button>
            </div>
        </div>
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 bg-gray-100">
    <!-- Nueva Discusión de Proyecto -->
    <div class="bg-blue-200 rounded-lg shadow-lg p-4">
      <div class="flex justify-between items-center">
        <span class="text-sm font-bold">12:30 - 15:45</span>
        <button class="text-xl">...</button>
      </div>
      <h2 class="text-xl font-bold mt-2">Nueva Discusión de Proyecto</h2>
      <div class="flex items-center mt-3">
        <div class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center">VC</div>
        <div class="ml-2 text-sm">+3</div>
      </div>
    </div>
  
    <!-- Datos de Ventas -->
    <div class="bg-white rounded-lg shadow-lg p-4">
      <h2 class="text-lg font-bold">Datos de Ventas</h2>
      <p class="text-sm">Anual</p>
      <div class="text-2xl font-bold mt-3">$38.96 USD</div>
      <div class="text-green-500 mt-1">+2.75%</div>
      <div class="flex justify-between items-center mt-3">
        <span class="text-xs">1 Año: 22 - 23 Abril</span>
      </div>
    </div>
  
    <!-- Ganancias del Día -->
    <div class="bg-gray-200 rounded-lg shadow-lg p-4">
      <div>
        <h2 class="text-lg font-bold">Ganancias de Hoy</h2>
        <p class="text-xl font-bold">$2890</p>
      </div>
      <div class="mt-3">
        <h3 class="text-lg font-bold">Reservas de Hoy</h3>
        <p class="text-xl font-bold">24</p>
      </div>
      <div class="mt-3">
        <h3 class="text-lg font-bold">Balance Total</h3>
        <p class="text-xl font-bold">$2M</p>
      </div>
    </div>
  
  
   <></div>