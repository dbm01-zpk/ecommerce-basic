<?php
namespace App\Src\Users\Domain;

use Exception;

trait UserValidationTrait {

    public function isSamePassword(string $password, string $confirm_password) {
        if ($password !== $confirm_password) {
            throw new Exception("PASSWORD: Not is equal to confirm password.");
        }

    }

}