<?php

/*===================================
|     Web Application Firewall      |
|  Here is where you apply global   |
|  security settings (IP bans,      |
|  traffic monitoring, etc.).       |
|==================================*/

use Src\Security\IpCheck;

IpCheck::isBannedIp();