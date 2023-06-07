<?php
use GuzzleHttp\Client;

class fetchStats
{
    public static function countAdmins()
    {
        $client = new Client(['defaults' => ['exceptions' => false]]);

        $response = $client->get('http://127.0.0.1:8090/api/collections/admins/records');

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            if (isset($responseData['totalItems'])) {
                return $responseData['totalItems'];
            } else {
                // Log an error if the "totalItems" key is not found
                error_log('Error: "totalItems" key not found in the response.');
            }
        } else {
            // Log an error if the API request is not successful
            error_log('Error: API request failed. Status Code: ' . $response->getStatusCode());
        }

        return 0; // Default value if there is an error
    }
    public static function countUsers()
    {
        $client = new Client(['defaults' => ['exceptions' => false]]);

        $response = $client->get('http://127.0.0.1:8090/api/collections/users/records');

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            if (isset($responseData['totalItems'])) {
                return $responseData['totalItems'];
            } else {
                // Log an error if the "totalItems" key is not found
                error_log('Error: "totalItems" key not found in the response.');
            }
        } else {
            // Log an error if the API request is not successful
            error_log('Error: API request failed. Status Code: ' . $response->getStatusCode());
        }

        return 0; // Default value if there is an error
    }
    public static function listAdmins()
    {
        $client = new Client(['defaults' => ['exceptions' => false]]);

        $response = $client->get('http://127.0.0.1:8090/api/collections/admins/records');

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            foreach($responseData['items'] as $item) {
                $username = $item[username];

                $html = '<li class="list-group-item">' . $username . '</li>';

                return $html;
            }
        }
    }
}

