<?php

// Twilio credentials
$accountSid = 'AC770eb6e5c1cf60f3e0b32a43238f1ea8';
$authToken = '7837a6d03d6024ccc2300a598fe92374';

// Message Service SID
$messageServiceSid = 'MGacf67721d2a8089e7774a288620b0ef9';

// API endpoint and parameters
$apiUrl = 'https://api.twilio.com/2010-04-01/Accounts/' . $accountSid . '/Messages.json';

$payload = array(
    'From' => $messageServiceSid,
    'To' => '+36702702183',
    'Body' => 'Hello, this is a test message from Twilio!'
);

// cURL initialization
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
curl_setopt($ch, CURLOPT_USERPWD, $accountSid . ':' . $authToken);

// Send the request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    $error = 'Error: ' . curl_error($ch);
    // Handle the error accordingly
} else {
    // Get the HTTP status code
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Handle the response accordingly
    if ($statusCode == 201) {
        // Message sent successfully
        echo 'Message sent!';
    } else {
        // Message sending failed
        echo 'Message failed to send. Status code: ' . $statusCode;
    }
}

// Close cURL
curl_close($ch);
