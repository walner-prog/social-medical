<div class="p-4 bg-gray-100 rounded mt-2">
    <div class="flex items-center space-x-4">
        @if($reply->user->avatar)
            <img src="{{ asset('storage/' . $reply->user->avatar) }}" class="w-8 h-8 rounded-full">
        @else
            <div class="w-8 h-8 flex items-center justify-center bg-gray-400 text-white rounded-full">
                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
            </div>
        @endif
        <div>
            <span class="font-semibold">{{ $reply->user->name }}</span>
            <span class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <p class="mt-1 text-gray-700">{{ $reply->content }}</p>
    @if($reply->user_id === auth()->id())
        <button wire:click="editReply({{ $reply->id }})" class="text-sm text-blue-500">Editar</button>
        <button wire:click="deleteReply({{ $reply->id }})" class="text-sm text-red-500 ml-2">Eliminar</button>
    @endif
</div>
