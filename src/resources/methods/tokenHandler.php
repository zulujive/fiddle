<?php
use GuzzleHttp\Client;

$client = new Client();
require_once __DIR__ . '/../../../config.php';

class tokenHandler
{
    public static function createToken($type, $enabled, $user)
    {
        global $client;
        $uuid = bin2hex(random_bytes(32));
        $response = $client->post(DB_HOST . '/api/collections/tokens/records', [
            'json' => [
                'token' => $uuid,
                'valid' => $enabled,
                'for' => $type,
                'userID' => $user,
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $token = $responseData['token'];
            return $token;
        }
    }
    public static function disableToken($token) {
        global $client;

        $id = this::findToken($token);

        $response = $client->patch(DB_HOST . '/api/collections/tokens/records/' . $id, [
            'json' => [
                'valid' => false,
            ]
        ]);

        $responseData = json_decode($response->getBody(), true);
        
        $state = $responseData['valid'];
        return $state;

    }
    protected static function findToken($token) {
        global $client;

        $response = $client->get(DB_HOST . '/api/collections/tokens/records?filter=(token=' . $token . ')');
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $array = $responseData['items'];
            $firstItem = $array[0];
            $id = $firstItem['id'];
            return $id;
        }
    }
    public static function verifyToken($token, $user) {
        global $client;

        $response = $client->get(DB_HOST . '/api/collections/tokens/records?filter=(token=' . $token . ')');
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $array = $responseData['items'];
            $firstItem = $array[0];
            $validUser = $firstItem['userID'];
            $enabled = $firstItem['valid'];
            if ($enabled == true && $validUser == $user) {
                $valid = true;
            } else {
                $valid = false;
            }
            return $valid;
        }
    }
}