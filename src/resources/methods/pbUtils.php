<?php
use GuzzleHttp\Client;


class pbUtils
{
    public function pbAuth($type, $identifier, $password)
    {
        $client = new Client();

        if ($type === 'password')
        {
            try {
                $response = $client->post('' . config('DB_HOST') . '/api/collections/admins/auth-with-password', [
                    'json' => [
                        'identity' => $identifier,
                        'password' => $password,
                    ]
                ]);
                if ($response->getStatusCode() === 200) {
                    $responseData = json_decode($response->getBody(), true);

                    return [
                        'authenticated' => true,
                        'responseData' => $responseData,
                    ];
                }
            } catch (GuzzleHttp\Exception\ClientException $e) {
                return [
                    'authenticated' => false,
                    'responseData' => null,
                ];
            }
        }
    }
}