<?php
use GuzzleHttp\Client;

class fetchStats
{
    public static function countAdmins()
    {
        $client = new Client();

        $response = $client->get('http://127.0.0.1:8090/api/collections/admins/records');

        $responseData = json_decode($response->getBody(), true);
        return $responseData['totalItems'];

    }
}
