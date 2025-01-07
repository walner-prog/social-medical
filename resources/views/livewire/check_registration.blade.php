<div>
    <!-- Notification container -->
    @if(!$isRegistered) <!-- Aquí usamos la variable que hemos pasado mediante compact() -->
    <div id="notification" class="fixed bottom-4 right-4 bg-blue-600 text-white p-4 rounded-lg shadow-lg flex items-center space-x-4 z-50" style="display: flex;" data-aos="fade-up" data-aos-duration="800">
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-plus text-xl"></i>
            <span class="text-sm">¡Aún no te has registrado! Regístrate para acceder a todas las funciones.</span>
        </div>
        <div class="ml-4">
            <button onclick="closeNotification()" class="text-white text-lg">&times;</button>
        </div>
        <div class="ml-4">
            <a href="/register" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-full text-sm">Regístrate</a>
        </div>
        <div class="ml-4">
            <a href="/login" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-full text-sm">Iniciar sesión</a>
        </div>
    </div>
    @endif
</div>


<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000, // Duración de la animación
        once: true, // Solo ejecutar una vez
    });

    // Función para cerrar la notificación
    function closeNotification() {
        const notification = document.getElementById('notification');
        notification.style.display = 'none'; // Ocultar la notificación
    }
</script>
