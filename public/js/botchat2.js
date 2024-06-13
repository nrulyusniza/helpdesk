//BUTTON ANSWER VIDEO
function myFunction() {
    document.getElementById("bot2").style.display = "block"
}

// $(document).ready(function(){
//     var user1ans1 = document.querySelector(".user1ans1");
//     user1ans1.addEventListener("click",function(){
//         setTimeout(function(){
//             $("#bot2").show();
//         },500);
//     })
// })

// BUTTON TOGGLE
var btn = document.getElementById('btn')

function leftClick() {
	btn.style.left = '0'
}

function rightClick() {
	btn.style.left = '50px'
}

var arrLang = new Array();
    arrLang['en'] = new Array();
    arrLang['ms'] = new Array();

    // ENGLISH CONTENT
    arrLang['en']['title'] = 'NCO HELPDESK';
    arrLang['en']['greeting'] = 'Hello✋ Welcome to the NCO Helpdesk';
    arrLang['en']['create ticket'] = 'Create Ticket';
    arrLang['en']['create consumable'] = 'Create Consumable';
    arrLang['en']['video'] = 'Video to create a ticket';
    arrLang['en']['send'] = 'Send message here...';

    // MALAY CONTENT
    // arrLang['ms']['title'] = 'NCO PUSAT BANTUAN';
    arrLang['ms']['title'] = 'NCO MEJA BANTUAN';
    arrLang['ms']['greeting'] = 'Salam✋ Selamat Datang ke NCO Meja Bantuan';
    arrLang['ms']['create ticket'] = 'Daftar Tiket';
    arrLang['ms']['create consumable'] = 'Daftar Barang Pakai Habis';
    arrLang['ms']['video'] = 'Video untuk mendaftar tiket';
    arrLang['ms']['send'] = 'Hantar pesanan disini...';

    // TRANSLATION
    $(function() {
        $('.toggle-btn').click(function() {
            var lang = $(this).attr('id');

        $('.lang').each(function(index, item) {
            $(this).text(arrLang[lang][$(this).attr('key')]);
            });
        });
    });

// COLLAPSIBLE
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

// CURRENT TIME
function getTime() {
    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();

    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    let time = hours + ":" + minutes;
    return time;
}

// FIRST MESSAGE
function firstBotMessage() {
    let firstMessage = "Hello✋ Welcome to the NCO Helpdesk"
    document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span class="lang" key="greeting">' + firstMessage + '</span></p>';

    let time = getTime();

    $("#chat-timestamp").append(time);
    document.getElementById("userInput").scrollIntoView(false);
}

firstBotMessage();

// RESPONSE
function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="botText"><span>' + botResponse + '</span></p>';
    $("#chatbox").append(botHtml);

    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

//RESPONSE TEXT FROM INPUT BOX
function getResponse() {
    let userText = $("#textInput").val();

    if (userText == "") {
        userText = "..........";
    }

    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    setTimeout(() => {
        getHardResponse(userText);
    }, 1000)

}

// Handles sending text via button clicks
function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

function sendButton() {
    getResponse();
}

// PRESS ENTER TO SEND A MESSAGE
$("#textInput").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});

// RESPONSE CONVERSATION
function getBotResponse(message) {
    // MALAY KOMUNIKASI
    if (message == "salam" || message == "Salam" || message == "SALAM") {
        return "Salam perkenalan. Apa yang boleh saya bantu ?";
    } else if (message == "saya nak daftar tiket" || message == "daftar tiket" || message == "tiket" || message == "permintaan" || message == "permintaan tiket") {
        return window.location.pathname=("{{route('issues.allissuecreate')}}");
    } else if (message == "saya nak daftar barang pakai buang" || message == "daftar barang pakai buang" || message == "barang pakai buang" || message == "permintaan" || message == "permintaan barang pakai buang") {
        return window.location.pathname=("{{route('issues.allissuecreate')}}");
    } else if (message == "asas pengetahuan" || message == "Asas Pengetahuan" || message == "ASAS PENGETAHUAN") {
        return window.location.pathname=("{{route('knowledgebases.allknowledgebase')}}");
    } else if (message == "laporan" || message == "Laporan" || message == "LAPORAN") {
        return window.location.pathname=("{{route('tickets.report.producereport')}}");
    } else if (message == "pengguna" || message == "Pengguna" || message == "PENGGUNA") {
        return window.location.pathname=("{{route('users.alluser')}}");
    } else if (message == "terima kasih" || message == "Terima kasih" || message == "TERIMA KASIH" || message == "Terima Kasih") {
        return "Sama-sama!";
    }

    // ENGLISH CONVERSATION
    if (message == "hello" || message == "Hello" || message == "HELLO" ||
        message == "hye" || message == "Hye" || message == "HYE" ||
        message == "hi" || message == "Hi" || message == "HI") {
        return "Nice to meet you. What can I do for you ?";
    } else if (message == "I want to create a ticket" || message == "create ticket" || message == "ticket" || message == "request" || message == "request ticket") {
        return window.location.pathname=("{{route('issues.allissuecreate')}}");
    } else if (message == "I want to create a consumable" || message == "create consumable" || message == "consumable" || message == "request" || message == "request consumable") {
        return window.location.pathname=("{{route('issues.allissuecreate')}}");
    } else if (message == "knowledge base" || message == "Knowledge Base" || message == "KNOWLEDGE BASE") {
        return window.location.pathname=("{{route('knowledgebases.allknowledgebase')}}");
    } else if (message == "reporting" || message == "Reporting" || message == "REPORTING") {
        return window.location.pathname=("{{route('tickets.report.producereport')}}");
    } else if (message == "user" || message == "User" || message == "USER") {
        return window.location.pathname=("{{route('users.alluser')}}");
    } else if (message == "thank you" || message == "Thank you" || message == "THANK YOU" || message == "Thank You") {
        return "You are welcome!";
    } else {
        return "Sorry! I don't understand. Please rephrase your sentence or explore the Menu options.";
        
    }
}