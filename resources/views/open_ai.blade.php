<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat Interface</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-12 max-w-3xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">GPT-3.5 Turbo Chat</h1>
            <p class="text-gray-600">Ask anything to the AI assistant</p>
        </div>

        <!-- Chat Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Response Area -->
            <div id="response-area" class="p-6 h-96 overflow-y-auto bg-gray-50 border-b border-gray-200">
                <div class="flex justify-center items-center h-full text-gray-400">
                    <p>Your AI responses will appear here...</p>
                </div>
            </div>

            <!-- Input Form -->
            <form id="ai-form" class="p-4 bg-white">
                @csrf
                <div class="flex space-x-2">
                    <div class="flex-grow relative">
                        <input 
                            type="text" 
                            name="question" 
                            id="user-input"
                            placeholder="Type your question here..." 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none transition-all"
                            autocomplete="off"
                        >
                        <button 
                            type="button" 
                            id="clear-btn"
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 hidden"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <button 
                        type="submit" 
                        id="submit-btn"
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 transition-all flex items-center"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send
                    </button>
                </div>
                <div class="mt-2 text-xs text-gray-500 flex justify-between">
                    <span id="char-counter">0/1000 characters</span>
                    <span>Powered by OpenAI GPT-3.5-turbo</span>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('ai-form');
            const input = document.getElementById('user-input');
            const responseArea = document.getElementById('response-area');
            const submitBtn = document.getElementById('submit-btn');
            const clearBtn = document.getElementById('clear-btn');
            const charCounter = document.getElementById('char-counter');

            // Character counter
            input.addEventListener('input', function() {
                const count = this.value.length;
                charCounter.textContent = `${count}/1000 characters`;
                clearBtn.classList.toggle('hidden', count === 0);
            });

            // Clear input
            clearBtn.addEventListener('click', function() {
                input.value = '';
                charCounter.textContent = '0/1000 characters';
                this.classList.add('hidden');
                input.focus();
            });

            // Form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const question = input.value.trim();
                
                if (!question) return;
                
                // Disable button during request
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
                
                // Add user message to chat
                addMessage('user', question);
                input.value = '';
                charCounter.textContent = '0/1000 characters';
                clearBtn.classList.add('hidden');
                
                try {
                    const response = await fetch('/ask', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ question })
                    });
                    
                    const data = await response.json();
                    addMessage('assistant', data.response || data.message);
                } catch (error) {
                    addMessage('assistant', 'Sorry, an error occurred. Please try again later.', true);
                    console.error('Error:', error);
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Send';
                }
            });
            
            // Add message to chat
            function addMessage(role, content, isError = false) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `mb-4 flex ${role === 'user' ? 'justify-end' : 'justify-start'}`;
                
                const bubble = document.createElement('div');
                bubble.className = `max-w-[80%] rounded-lg px-4 py-3 ${
                    role === 'user' 
                        ? 'bg-blue-500 text-white rounded-br-none' 
                        : isError 
                            ? 'bg-red-100 text-red-800 rounded-bl-none' 
                            : 'bg-gray-200 text-gray-800 rounded-bl-none'
                }`;
                bubble.textContent = content;
                
                messageDiv.appendChild(bubble);
                
                // If response area is empty, clear the placeholder
                if (responseArea.firstChild?.classList?.contains('flex')) {
                    responseArea.innerHTML = '';
                }
                
                responseArea.appendChild(messageDiv);
                responseArea.scrollTop = responseArea.scrollHeight;
            }
        });
    </script>
</body>
</html>