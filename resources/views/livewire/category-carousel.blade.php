<div x-data="{ currentIndex: 0, interval: 3000, timer: null }" class="relative">
    <div class="overflow-hidden rounded-lg">
        <ul 
            x-init="() => { 
                $nextTick(() => { 
                    play(); 
                }); 
            }"
            @mouseenter="pause()"
            @mouseleave="play()"
            class="flex transition-transform duration-500 ease-in-out"
            :style="'translate-x-' + currentIndex * 100 + '%'"
            ref="slides"
        >
            @foreach ($categories as $category)
                <li class="flex-shrink-0 w-full">
                    <div class="p-4 bg-gray-100 rounded-lg shadow-md hover:shadow-lg">
                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="absolute inset-x-0 bottom-0 flex justify-center">
        @foreach ($categories as $index => $category)
            <button 
                x-on:click="currentIndex = {{ $index }}"
                class="w-3 h-3 mx-1 rounded-full bg-gray-300 hover:bg-gray-500"
            ></button>
        @endforeach
    </div>
</div>