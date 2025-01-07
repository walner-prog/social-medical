<div class="bg-card-bg rounded-3xl p-8 text-white shadow-lg animate-fade-in w-full max-w-xl text-center">
    <div class="mb-8">
        <div class="w-16 h-16 bg-white/10 rounded-full mx-auto mb-4 flex items-center justify-center">
            <span class="text-2xl font-bold">g</span>
        </div>
        <h2 class="text-2xl font-semibold mb-2">{{ $title }}</h2>
        <p class="text-gray-300 text-sm">{{ $description }}</p>
    </div>

    <div class="space-y-3 mb-8">
        @foreach($links as $link)
            <a href="{{ $link['url'] }}" class="w-full bg-white text-gray-800 hover:bg-button-hover block py-2 px-4 rounded-md">{{ $link['label'] }}</a>
        @endforeach
    </div>

    <div class="flex justify-center space-x-4">
        <a href="{{ $socialLinks['facebook'] }}" class="p-2 hover:bg-white/10 rounded-full transition-colors">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="{{ $socialLinks['instagram'] }}" class="p-2 hover:bg-white/10 rounded-full transition-colors">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="{{ $socialLinks['linkedin'] }}" class="p-2 hover:bg-white/10 rounded-full transition-colors">
            <i class="fab fa-linkedin-in"></i>
        </a>
    </div>
</div>


{{-- 
  se in cluyr en una vista de blade asi  ///////
   <x-links-card
    title="Big Guppy Media Links"
    description="Browse through some of our links and pages."
    :links="[
        ['url' => 'https://example.com', 'label' => 'Website'],
        ['url' => 'https://example.com/services', 'label' => 'Services'],
        // ... más enlaces
    ]"
    :social-links="[
        'facebook' => 'https://www.facebook.com/yourpage',
        'instagram' => 'https://www.instagram.com/yourprofile',
        'linkedin' => 'https://www.linkedin.com/in/yourprofile'
    ]"
/>

--}}