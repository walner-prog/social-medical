<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'social medical') }}</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" sizes="100x100" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900">
            <!-- Botón de cambio de tema -->
            <div class="w-full flex justify-end pr-8 pt-6">
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>
            </div>
    
            <!-- Contenedor principal con dos columnas -->
            <div class="flex flex-col sm:flex-row items-center bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mt-6">
                <!-- Sección del logo -->
                <div class="flex items-center justify-center p-8 sm:w-auto">
                    <a href="/" wire:navigate>
                        <x-application-logo class="fill-current text-gray-500" />
                    </a>
                </div>
    
                <!-- Sección del formulario -->
                <div class="w-full sm:w-2/3 p-6">
                    <div class="w-full max-w-md mx-auto p-4 dark:bg-gray-800 ">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    
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
    </body>
    
    
</html>
