<DOCTYPE html>
<html lang="eng" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CHATBOT</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
        <script src="{{ asset('js/script.js') }}" defer></script>
        <script src="{{ asset('video/Request.mp4') }}" defer></script>
    </head>
    <body>
        <button class="chatbot-toggler">
        <span class="material-symbols-outlined">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
        </button>
        <div class="chatbot">
            <header>
                <h2>NCO HELPDESK</h2>
                <span class="close-btn material-symbols-outlined">close</span>
                </header>
                <ul class="chatbox">
                    <li class="chat incoming">
                        <span class="material-symbols-outlined">smart_toy</span>
                        <p>Hello User ✋ <br>Welcome to the NCO Helpdesk</p>
                    </li><br>
                    <li class="chat incoming">
                    <span class="material-symbols-outlined">smart_toy</span>
                        <p>Did you want to create a ticket ? <br>Click link here : <a href="{{route('equipments.create')}}" target="_blank"><b>Request Ticket </b></a></p>      
                    </li><br>
                    <li class="chat incoming">
                    <span class="material-symbols-outlined">smart_toy</span>
                        <p>Please watch a video below as a reference :
                            <video width="180px" height="100px" controls>
                            <source src="video/Request.mp4" type="video/mp4"></p>
                    </li>
                </ul>
                <div class="chat-input">
                    <textarea placeholder="Type message here..." required></textarea>
                    <span id="send-btn" class="material-symbols-outlined">send</span>
                </div>
        </div>
    </body>
</html>