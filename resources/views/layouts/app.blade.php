<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'social medical') }}</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/classic/styles.css">

       
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

        


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/alpine.min.js"></script>

        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <style>
            html.dark {
    background-color: #1a202c;
    color: #a0aec0;
    }

    html {
    background-color: #f7fafc;
    color: #1a202c;
    }

   /* Tema claro */
:root {
    --ck-color-base-background: #ffffff; /* Fondo del editor en tema claro */
    --ck-color-base-foreground: #000000; /* Texto en tema claro */
    --ck-color-focus-border: #2563eb;   /* Borde de enfoque en tema claro */
}

/* Tema oscuro (con el prefijo de Tailwind `dark:`) */
.dark {
    --ck-color-base-background: #1e293b; /* Fondo del editor en tema oscuro */
    --ck-color-base-foreground: #f8fafc; /* Texto en tema oscuro */
    --ck-color-focus-border: #3b82f6;   /* Borde de enfoque en tema oscuro */
}

/* Tema claro */
:root {
    --ck-color-button-default-background: #f3f4f6; /* Fondo del botón en tema claro */
    --ck-color-button-default-hover-background: #e5e7eb; /* Fondo al pasar el cursor */
    --ck-color-button-on-background: #49649f; /* Fondo cuando el botón está activo */
    --ck-color-button-default-border: #d1d5db; /* Borde del botón */
    --ck-color-icon: #1f2937; /* Icono en los botones */
    --ck-color-icon-hover: #111827; /* Icono al pasar el cursor */
}

/* Tema oscuro */
.dark {
    --ck-color-button-default-background: #6b7e9c; /* Fondo del botón en tema oscuro */
    --ck-color-button-default-hover-background: #164587; /* Fondo al pasar el cursor */
    --ck-color-button-on-background: #6ba4ff; /* Fondo cuando el botón está activo */
    --ck-color-button-default-border: #6b7280; /* Borde del botón */
    --ck-color-icon: #f7faff; /* Icono en los botones */
    --ck-color-icon-hover: #f3f4f6; /* Icono al pasar el cursor */
}




    

        </style>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
       
            <livewire:layout.footer />
        </div>

        @livewireScripts
         <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const themeToggleBtn = document.getElementById('theme-toggle');
                const darkIcon = document.getElementById('theme-toggle-dark-icon');
                const lightIcon = document.getElementById('theme-toggle-light-icon');
        
                // Obtener tema guardado en Local Storage o detectar preferencia del sistema
                const currentTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
                // Actualizar la interfaz y el DOM
                const applyTheme = (theme) => {
                    if (theme === 'dark') {
                        document.documentElement.classList.add('dark');
                        darkIcon.classList.add('hidden');
                        lightIcon.classList.remove('hidden');
                    } else {
                        document.documentElement.classList.remove('dark');
                        darkIcon.classList.remove('hidden');
                        lightIcon.classList.add('hidden');
                    }
                    localStorage.setItem('theme', theme);
                };
        
                applyTheme(currentTheme);
        
                // Alternar el tema
                themeToggleBtn.addEventListener('click', () => {
                    const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
                    applyTheme(newTheme);
                });
            });
        </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggleBtn = document.getElementById('theme-toggle-btn');
        const darkIcon = document.getElementById('theme-toggle-dark-icon-btn');
        const lightIcon = document.getElementById('theme-toggle-light-icon-btn');

        // Obtener tema guardado en Local Storage o detectar preferencia del sistema
        const currentTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        // Actualizar la interfaz y el DOM
        const applyTheme = (theme) => {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }
            localStorage.setItem('theme', theme);
        };

        applyTheme(currentTheme);

        // Alternar el tema
        themeToggleBtn.addEventListener('click', () => {
            const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
            applyTheme(newTheme);
        });
    });
</script>



    
        
    </body>
</html>
