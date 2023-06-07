<?php
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
            }
        }

        return 0; // Default value if the totalItems key is not found or the response is not successful
    }
}
