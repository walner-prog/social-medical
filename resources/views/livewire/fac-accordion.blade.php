<!-- resources/views/livewire/faq-accordion.blade.php -->
<div class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-800 py-12 px-6 md:px-12 text-white">
    <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-10 text-indigo-500">
        Preguntas Frecuentes
    </h2>

    <div class="space-y-4">
        @foreach ($questions as $key => $question)
            <div class="border border-indigo-500 rounded-lg overflow-hidden shadow-lg group">
                <button class="w-full text-left px-6 py-4 bg-gray-800 hover:bg-gray-700 focus:outline-none flex items-center justify-between transition">
                    <span class="text-lg font-medium text-white">{{ $question->question }}</span>
                    <svg class="w-6 h-6 text-indigo-500 group-hover:rotate-180 transform transition duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="max-h-0 overflow-hidden bg-gray-700 px-6 transition-all duration-500">
                    <p class="py-4 text-gray-300">
                        {{ $question->answer }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
