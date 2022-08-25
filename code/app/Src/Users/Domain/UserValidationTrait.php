<?php
namespace App\Src\Users\Domain;

use Exception;
use Illuminate\Support\Facades\Auth;

trait UserValidationTrait {

    public function isSamePassword(string $password, string $confirm_password) {
        if ($password !== $confirm_password) {
            throw new Exception("PASSWORD: Not is equal to confirm password.");
        }

    }

    public function invalidAttempt(string $email, string $password) {
        if (Auth::attempt([
            'email'    => $email,
            'password' => $password,
        ])) {
            throw new Exception("Auth: Invalid attempt.");
        }
    }

}