<?php
use GuzzleHttp\Client;

class PocketBase
{
    private static function api($url, $method, $collection, $data, $action='')
    {
        $client = new Client();
        try {
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
            http_response_code(404);
            echo '<head>'
            echo "<link href=\"https:\/\/cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM\" crossorigin=\"anonymous\">";
            echo '</head>'
            echo '<body>'
            echo '<h1>Error: 404</h1>'
            echo '<h3>Cannot find template<h3>';
            echo '</body>'
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