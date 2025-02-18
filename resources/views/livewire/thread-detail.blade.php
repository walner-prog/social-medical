<div class="space-y-6">
    <!-- Mensajes de sesión -->
    @if(session()->has('message'))
        <div class="p-3 text-green-700 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @elseif(session()->has('error'))
        <div class="p-3 text-red-700 bg-red-100 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Detalle del tema -->
    <div class="p-6 bg-white rounded shadow dark:bg-gray-800">
        <h2 class="text-xl font-semibold">{{ $thread->title }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $thread->specialty ?? 'General' }}</p>
        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $thread->content }}</p>
    </div>

    <!-- Respuestas -->
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">Respuestas</h3>

        <div class="space-y-6">
            @foreach($thread->replies->where('parent_id', null) as $reply)
                <div class="p-4 bg-white rounded shadow dark:bg-gray-800">
                    <div class="flex items-center space-x-4">
                        <div>
                            @if($reply->user->avatar)
                                <img src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}"
                                    class="w-10 h-10 rounded-full">
                            @else
                                <div class="w-10 h-10 flex items-center justify-center bg-indigo-500 text-white rounded-full">
                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <span class="font-semibold">{{ $reply->user->name }}</span>
                            <span class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        @if($reply->user_id === auth()->id())
                            <div class="ml-auto relative">
                                <button wire:click="toggleDropdown({{ $reply->id }})" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                               @if($openDropdown === $reply->id)
                      
                               <div class="absolute right-0 mt-2 bg-white border rounded shadow-md">
                                <button wire:click="editReply({{ $reply->id }})" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Editar
                                </button>
                                <button wire:click="deleteReply({{ $reply->id }})" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Eliminar
                                </button>

                             
                                </div>
                            @endif
                            </div>

                            
                        @endif
                    </div>
                    @if($openDropdown === $reply->id)
                    <div class="pl-6 mt-4">
                        <form wire:submit.prevent="createReply({{ $reply->id }})">
                            <textarea 
                                wire:model="replyContent" 
                                class="w-full p-2 mt-2 border rounded dark:bg-gray-700" 
                                placeholder="Escribe tu respuesta aquí..."
                            ></textarea>
                            @error('replyContent') <p class="text-red-500">{{ $message }}</p> @enderror

                            <button type="submit" class="px-4 py-2 mt-4 bg-blue-600 text-white rounded">
                                Publicar Respuesta
                            </button>
                        </form>
                    </div>
                @endif
                    <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $reply->content }}</p>
                    <button wire:click="createReply({{ $reply->id }})" class="text-blue-500 text-sm mt-2">Responder</button>
                    <div class="pl-6">
                        @foreach($reply->replies as $childReply)
                            <!-- Repetir bloque para respuestas anidadas -->
                            @include('partials.reply', ['reply' => $childReply])
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>

    <!-- Formulario de respuesta -->
    <div class="p-6 bg-white rounded shadow dark:bg-gray-800">
        <h3 class="text-lg font-semibold">
            {{ $editingReplyId ? 'Editar Respuesta' : 'Añadir una Respuesta' }}
        </h3>

        <form wire:submit.prevent="{{ $editingReplyId ? 'updateReply' : 'createReply' }}">
            <textarea 
                wire:model="replyContent" 
                class="w-full p-2 mt-2 border rounded dark:bg-gray-700" 
                placeholder="Escribe tu respuesta aquí..."
            ></textarea>
            @error('replyContent') <p class="text-red-500">{{ $message }}</p> @enderror

            <button type="submit" class="px-4 py-2 mt-4 bg-blue-600 text-white rounded">
                {{ $editingReplyId ? 'Actualizar Respuesta' : 'Publicar Respuesta' }}
            </button>
        </form>
    </div>
</div>
