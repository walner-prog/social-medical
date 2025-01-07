<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'social medical') }}</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      
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
