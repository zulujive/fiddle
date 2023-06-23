<?php
namespace Controllers\AdminController;

class AuthController
{
    /*=================================
    |    Login, logout & register     |
    ===================================
    */
    public function panelLogin() {
        require_once __DIR__ . '/../resources/views/login.php';
    }
    public function panelLogout() {
        require_once __DIR__ . '/../resources/views/logout.php';
    }
    public function newUser() {
        require_once __DIR__ . '/../resources/views/register.php';
    }

    /*=================================
    |     2-Factor Authentication     |
    ===================================
    */
    public function OTP() {
        require_once __DIR__ . '/../resources/views/dualFactor.php';
    }
    public function verifyOTP() {
        require_once __DIR__ . '/../resources/views/dualFactorVerify.php';
    }
    public function enableOTP() {
        require_once __DIR__ . '/../resources/views/dualFactorEnable.php';
    }
    public function deployOTP() {
        require_once __DIR__ . '/../resources/views/dualFactorInfo.php';
    }
    public function generateQR() {
        require_once __DIR__ . '/../resources/views/generateQR.php';
    }
}