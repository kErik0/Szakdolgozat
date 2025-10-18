<div id="chatbot-wrapper" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; font-size: 14px;">

    <!-- Robot ikon, alapból látszik -->
    <div id="chatbot-icon" 
         style="width: 50px; height: 50px; background: #6366f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        🤖
    </div>

    <!-- Chat ablak, alapból elrejtve -->
    <div id="chatbot-container" 
         style="display: none; width: 300px; background: white; border: 1px solid #ccc; border-radius: 8px; padding: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); margin-top: 10px;">
        <div style="display: flex; justify-content: flex-end;">
            <button id="chatbot-close" style="border: none; background: transparent; font-weight: bold; cursor: pointer;">✖</button>
        </div>
        <div id="chat-messages" style="max-height: 200px; overflow-y: auto; margin-bottom: 10px;"></div>
        <div style="display: flex; gap: 5px;">
            <input type="text" id="chat-input" placeholder="Kérdezz valamit..." 
                   style="flex: 1; border: 1px solid #ccc; border-radius: 4px; padding: 4px;">
            <button id="chat-send" 
                    style="background: #6366f1; color: white; border: none; border-radius: 4px; padding: 4px 8px;">
                Küldés
            </button>
        </div>
    </div>

</div>

<script>
const icon = document.getElementById('chatbot-icon');
const container = document.getElementById('chatbot-container');
const closeBtn = document.getElementById('chatbot-close');
const input = document.getElementById('chat-input');
const sendBtn = document.getElementById('chat-send');
const messages = document.getElementById('chat-messages');

icon.addEventListener('click', () => {
    container.style.display = 'block';
    icon.style.display = 'none';
});

closeBtn.addEventListener('click', () => {
    container.style.display = 'none';
    icon.style.display = 'flex';
});

function sendMessage() {
    const message = input.value.trim();
    if (!message) return;

    messages.innerHTML += `<div><b>Te:</b> ${message}</div>`;

    fetch('{{ route('chatbot.handle') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message })
    })
    .then(res => res.json())
    .then(data => {
        messages.innerHTML += `<div><b>Bot:</b> ${data.response.replace(/\n/g, '<br>')}</div>`;
        messages.scrollTop = messages.scrollHeight;
    });

    input.value = '';
}

// Gombnyomásra
sendBtn.addEventListener('click', sendMessage);

// Enter lenyomásra az input mezőben
input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // megakadályozza a form submitot
        sendMessage();
    }
});
</script>