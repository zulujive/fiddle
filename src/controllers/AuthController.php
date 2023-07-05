<?php
namespace Src\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

class AuthController
{
    /*=================================
    |    Login, logout & register     |
    ===================================
    */
    public function panelLogin() {
        require_once __DIR__ . '/../resources/views/panel/auth/login.php';
    }
    public function panelLogout() {
        require_once __DIR__ . '/../resources/views/panel/auth/logout.php';
    }
    public function newUser() {
        require_once __DIR__ . '/../resources/views/panel/auth/register.php';
    }

    /*=================================
    |     2-Factor Authentication     |
    ===================================
    */
    public function OTP() {
        require_once __DIR__ . '/../resources/views/otp/dualFactor.php';
    }
    public function verifyOTP() {
        require_once __DIR__ . '/../resources/views/otp/dualFactorVerify.php';
    }
    public function enableOTP() {
        require_once __DIR__ . '/../resources/views/otp/dualFactorEnable.php';
    }
    public function deployOTP() {
        require_once __DIR__ . '/../resources/views/otp/dualFactorInfo.php';
    }
    public function generateQR() {
        require_once __DIR__ . '/../resources/views/otp/generateQR.php';
    }
}