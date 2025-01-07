<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat en Tiempo Real</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>
    <div x-data="chatApp" class="container">
        <h1>Chat en Tiempo Real</h1>
        <div class="chat-box" style="border:1px solid #ddd; height:300px; overflow-y:auto;">
            <template x-for="message in messages" :key="message.id">
                <div>
                    <strong x-text="message.username"></strong>: 
                    <span x-text="message.message"></span>
                </div>
            </template>
        </div>
        <input x-model="username" type="text" placeholder="Tu nombre">
        <input x-model="newMessage" type="text" plac
        eholder="Escribe un mensaje">
        <button @click="sendMessage">Enviar</button>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('chatApp', () => ({
                username: '',
                newMessage: '',
                messages: [],

                init() {
                    const pusher = new Pusher('0196ad41c21522346630', {
                   cluster: 'us2',
                      forceTLS: true
                     });

                    const channel = pusher.subscribe('chat');
                    channel.bind('message.sent', (data) => {
                        this.messages.push(data);
                    });
                },

                sendMessage() {
                    fetch('{{ route("chat.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            username: this.username,
                            message: this.newMessage,
                        })
                    });
                    this.newMessage = '';
                }
            }));
        });
    </script>
</body>
</html>
