<footer class="bg-gray-200 dark:bg-gray-800 dark:text-gray-300 py-8">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4">
        <!-- Columna 1: Información de la empresa -->
        <div>
            <h2 class="font-bold text-lg mb-4">Social Medical</h2>
            <p>Somos una plataforma médica para conectar pacientes con doctores de diversas especialidades.</p>
        </div>
        
        <!-- Columna 2: Enlaces rápidos -->
        <div>
            <h2 class="font-bold text-lg mb-4">Enlaces rápidos</h2>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Dashboard</a></li>
                <li><a href="{{ route('doctores.index') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Doctores</a></li>
                <li><a href="{{ route('productos.index') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Productos</a></li>
                <li><a href="{{ route('profile') }}" class="hover:underline dark:text-gray-300 dark:hover:text-white">Perfil</a></li>
            </ul>
        </div>

        <!-- Columna 3: Contacto -->
        <div>
            <h2 class="font-bold text-lg mb-4">Contacto</h2>
            <p>Correo: <a href="mailto:support@socialmedical.com" class="hover:underline dark:text-gray-300 dark:hover:text-white">support@socialmedical.com</a></p>
            <p>Teléfono: (555) 123-4567</p>
        </div>

        <!-- Columna 4: Redes sociales -->
        <div>
            <h2 class="font-bold text-lg mb-4">Síguenos</h2>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-500">Facebook</a></li>
                <li><a href="#" class="text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-500">Twitter</a></li>
                <li><a href="#" class="text-pink-500 hover:text-pink-400 dark:text-pink-400 dark:hover:text-pink-500">Instagram</a></li>
                <li><a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-500 dark:hover:text-blue-600">LinkedIn</a></li>
            </ul>
        </div>
    </div>

    <div class="text-center text-sm text-gray-400 dark:text-gray-500 mt-8">
        <p>&copy; {{ date('Y') }} Social Medical. Todos los derechos reservados.</p>
    </div>
</footer>
