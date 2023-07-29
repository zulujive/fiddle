<?php
namespace Src\Methods\Pb;
use GuzzleHttp\Client;

class PocketBaseUtils
{
    private static function api($url, $method, $collection, $data, $action='')
    {
        try {
            $client = new Client();
            $response = $client->request($method, $url . '/api/collections/' . $collection . '/records/' . $action, [
                'json' => $data,
                'headers' => [
                    'pb_token' => config('DB_KEY'),
                ]
            ]);
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

    public static function getTemplateName($templateId) {
        $data = [];
        $response = self::api(config('DB_HOST'), 'get', 'templates', $data, $templateId);
        if ($response['success'] == true) {
            $responseData = $response['responseData'];
            $imageName = $responseData["template"];
            return $imageName;
        } else {
            http_response_code(400);
            $returnData = [
                'error' => '404',
                'message' => 'resource not found'
            ];
            $jsonResponse = json_encode($returnData);
            echo $jsonResponse;
            exit();
        }
    }

    public static function getTemplateUrl($templateId) {
        $templateName = self::getTemplateName($templateId);
        $templateUrl = config('DB_HOST') . '/api/files/templates/' . $templateId . '/' . $templateName;
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

    public static function imgById($templateId) {
        $data = [];
        $response = self::api(config('DB_HOST'), 'get', 'templates', $data, $templateId);
        if ($response['success'] == true) {
            $responseData = $response['responseData'];
            return $responseData;
        }
    }
}