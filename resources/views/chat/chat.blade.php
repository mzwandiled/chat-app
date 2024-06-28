<!-- resources/views/chat.blade.php -->

<h1>Chat with AI</h1>

<form action="{{ route('generate-response') }}" method="post">
    @csrf
    <input type="text" name="user_input" placeholder="Type a message...">
    <button type="submit">Send</button>
</form>

<div id="chat-log">
    <!-- We'll display the chat log here -->
</div>

<script>
    // JavaScript code to send the form data to the server and display the response
    // (same as before)
    const form = document.querySelector('form');
    const chatLog = document.querySelector('#chat-log');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userInput = document.querySelector('input[name="user_input"]').value;

        try {
            const response = await fetch('{{ route('generate-response') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ user_input: userInput })
            });

            const responseData = await response.json();

            const responseText = responseData.response;

            const chatLogHtml = `<p>{{auth()->user()->name}}: ${userInput}</p><p>AI: ${responseText}</p>`;

            chatLog.innerHTML += chatLogHtml;

            document.querySelector('input[name="user_input"]').value = '';
        } catch (error) {
            console.error(error);
        }
    });
</script>
