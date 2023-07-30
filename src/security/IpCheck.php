<?php
namespace Src\Security;

use Src\Methods\Pb\PocketBaseUtils;

class IpCheck
{
    public static function isBannedIp() {
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        $isBanned = PocketBaseUtils::ipLookup($remoteAddr);
        if ($isBanned) {
            $json_response = json_encode([
                'error' => 403,
                'message' => 'using banned IP address'
            ]);
            http_response_code(403);
            echo $json_response;
            exit();
        }
    }
}