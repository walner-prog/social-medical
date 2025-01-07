<form class="bg-gray-900 rounded-3xl p-8 text-white shadow-lg animate-fade-in w-full max-w-xl" method="POST" action="">
    @csrf
  
    <div class="flex justify-between items-start mb-8">
      <div>
        <h2 class="text-2xl font-semibold mb-2 text-white">Contact Us</h2>
        <p class="text-gray-400 text-sm max-w-md">
          Ready to bring your vision to life or have questions about our services? Our team at Big Guppy Media is here to provide the guidance and support you need.
        </p>
      </div>
      <img src="/lovable-uploads/06d66da8-cfff-49ee-9347-bc3a62bf9b27.png" alt="Logo" class="w-20 h-20 object-contain" />
    </div>
  
    <div class="space-y-4">
      <div>
        <label for="name" class="text-sm mb-1 block text-gray-400">Full Name</label>
        <input type="text" name="name" id="name" class="bg-gray-800 border border-gray-700 rounded-md text-white px-3 py-2 w-full focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary-500" placeholder="Enter your name" required>
      </div>
      <div>
        <label for="email" class="text-sm mb-1 block text-gray-400">Email</label>
        <input type="email" name="email" id="email" class="bg-gray-800 border border-gray-700 rounded-md text-white px-3 py-2 w-full focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary-500" placeholder="Enter your email" required>
      </div>
      <div>
        <label for="phone" class="text-sm mb-1 block text-gray-400">Phone number</label>
        <input type="tel" name="phone" id="phone" class="bg-gray-800 border border-gray-700 rounded-md text-white px-3 py-2 w-full focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary-500" placeholder="Enter phone number">
      </div>
      <div>
        <label for="message" class="text-sm mb-1 block text-gray-400">Message</label>
        <textarea name="message" id="message" rows="4" class="bg-gray-800 border border-gray-700 rounded-md text-white px-3 py-2 w-full focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary-500" placeholder="Write your message here..."></textarea>
      </div>
    </div>
  
    <button type="submit" class="w-full bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition ease-in-out duration-300">Send message</button>
  </form>

  <script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.animate-fade-in').fadeIn(1000);
    });
</script>

@stack('scripts')
  </script>

  {{-- 
      se incluye en una plantilla de blade de esta forma <x-contact-form />
  
  --}}