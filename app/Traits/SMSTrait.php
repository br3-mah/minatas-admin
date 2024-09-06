<?php

namespace App\Traits;

trait SMSTrait{

    public function send_sms($data) {
        $message = $data['message'];
        $username = '';
        $password = '';

        $type = '0';
        $dlr = '1';
        $destination = $data['phone'];
        $source = '';

        // API endpoint
        $apiEndpoint = "http://rslr.connectbind.com:8080/bulksms/bulksms";

        // Build the query parameters
        $queryParams = http_build_query([
            'username' => $username,
            'password' => $password,
            'type' => $type,
            'dlr' => $dlr,
            'destination' => $destination,
            'source' => $source,
            'message' => $message,
        ]);

        // Full API URL with query parameters
        $apiUrl = "{$apiEndpoint}?{$queryParams}";

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options for GET request
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle cURL error
            echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Return the API response
        return $response;
    }
}
