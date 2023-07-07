<?php
use GuzzleHttp\Client;


class tokenHandler
{
    public static function createToken($type, $enabled, $user)
    {
        $client = new Client();
        $uuid = bin2hex(random_bytes(32));
        $response = $client->post(config('DB_HOST') . '/api/collections/tokens/records', [
            'json' => [
                'token' => $uuid,
                'valid' => $enabled,
                'for' => $type,
                'userID' => $user,
            ],
            'headers' => [
                'pb_token' => config('DB_KEY'),
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $token = $responseData['token'];
            return $token;
        }
    }
    public function disableToken($token) {
        $client = new Client();

        $id = $this->findToken($token);

        $response = $client->patch(config('DB_HOST') . '/api/collections/tokens/records/' . $id, [
            'json' => [
                'valid' => false,
            ],
            'headers' => [
                'pb_token' => config('DB_KEY'),
            ]
        ]);

        $responseData = json_decode($response->getBody(), true);
        
        $state = $responseData['valid'];
        return $state;

    }
    protected function findToken($token) {
        $client = new Client();

        $response = $client->get(config('DB_HOST') . '/api/collections/tokens/records?filter=(token=\'' . $token . '\')', [
            'headers' => [
                'pb_token' => config('DB_KEY'),
            ]
        ]);
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $array = $responseData['items'];
            $firstItem = $array[0];
            $id = $firstItem['id'];
            return $id;
        }
    }
    public static function verifyToken($token, $user) {
        $client = new Client();

        $response = $client->get(config('DB_HOST') . '/api/collections/tokens/records?filter=(token=\'' . $token . '\')', [
            'headers' => [
                'pb_token' => config('DB_KEY'),
            ]
        ]);
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $array = $responseData['items'];
            $firstItem = $array[0];
            $validUser = $firstItem['userID'];
            $enabled = $firstItem['valid'];
            if ($enabled == true && $validUser == $user) {
                $valid = true;
            } else {
                echo "Invalid or expired API key";
                $valid = false;
                exit();
            }
            return $valid;
        }
    }
}