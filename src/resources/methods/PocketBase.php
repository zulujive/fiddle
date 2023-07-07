<?php
use GuzzleHttp\Client;

class PocketBase
{
    private static function api($url, $method, $collection, $data, $action='')
    {
        $client = new Client();
        $response = $client->request($method, $url . '/api/collections/' . $collection . '/records/' . $action, [
            'json' => $data,
            'headers' => [
                'pb_token' => DB_KEY,
            ]
        ]);
        try {
            if ($response->getStatusCode() === 200) {
                $responseData = json_decode($response->getBody(), true);

                return [
                    'success' => true,
                    'responseData' => $responseData,
                ];
            } 
        } catch (GuzzleHttp\Exception\ClientException $e) {
            return [
                'success' => false,
                'responseData' => null,
            ];
        }
    }

    public static function authPwd($identifier, $password)
    {
        $client = new Client();

        try {
            $response = $client->post('' . DB_HOST . '/api/collections/admins/auth-with-password', [
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

    public static function getTemplateName($templateId) {
        $data = [];
        $response = self::api(DB_HOST, 'get', 'templates', $data, $templateId);
        if ($response['success'] == true) {
            $responseData = $response['responseData'];
            $imageName = $responseData["template"];
            return $imageName;
        } else {
            throw new Exception('Cannot find template');
        }
    }

    public static function getTemplateUrl($templateId) {
        $templateName = self::getTemplateName($templateId);
        $templateUrl = DB_HOST . '/api/files/templates/' . $templateId . '/' . $templateName;
        return $templateUrl;
    }

    public static function serveTemplate($templateId) {

        $client = new Client();

        $imageUrl = self::getTemplateUrl($templateId);
        $imageResponse = $client->get($imageUrl);
        $imageData = $imageResponse->getBody()->getContents();

        // Set the appropriate content-type header for the image
        header('Content-Type: ' . $imageResponse->getHeaderLine('Content-Type'));

        return $imageData;
    }
}