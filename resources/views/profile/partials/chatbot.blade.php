<div id="chatbot-wrapper" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; font-size: 14px;">

    <!-- Robot ikon, alapból látszik -->
    <div id="chatbot-icon" 
         style="width: 50px; height: 50px; background: #6366f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        🤖
    </div>

    <div id="chatbot-container"
         class="bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-gray-200"
         style="display:none; width:320px; border:1px solid #ddd; border-radius:12px; padding:12px; box-shadow:0 4px 18px rgba(0,0,0,0.25); margin-top:10px;">

        <div style="display:flex; justify-content:flex-end;">
            <button id="chatbot-close"
                    class="dark:text-gray-300"
                    style="border:none; background:transparent; font-weight:bold; cursor:pointer; font-size:16px;">
                ✖
            </button>
        </div>

        <div id="chat-messages"
             style="max-height:260px; overflow-y:auto; margin-bottom:12px; display:flex; flex-direction:column; gap:8px; padding:6px;">
        </div>

        <div style="display:flex; gap:6px;">
            <input type="text" id="chat-input"
                   class="bg-white text-gray-900 placeholder-gray-500 dark:bg-[#3a3a3a] dark:text-gray-100 dark:placeholder-gray-400"
                   placeholder="Kérdezz valamit..."
                   style="flex:1; border:1px solid #ccc; border-radius:20px; padding:6px 12px; font-size:14px;">
            <button id="chat-send"
                    class="dark:bg-indigo-600"
                    style="background:#6366f1; color:white; border:none; border-radius:20px; padding:6px 14px; font-size:14px;">
                ➤
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

    messages.innerHTML += `<div style="align-self:flex-end; background:#6366f1; color:white; padding:8px 12px; border-radius:16px; max-width:80%; word-wrap:break-word;">${message}</div>`;

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
        messages.innerHTML += `<div class="dark:text-gray-100" style="align-self:flex-start; background:#e5e7eb; color:#111; padding:8px 12px; border-radius:16px; max-width:80%; word-wrap:break-word;">${data.response.replace(/\n/g, '<br>')}</div>`;
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