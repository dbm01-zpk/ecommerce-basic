<?php
namespace App\Src\Users\Application;

use App\Models\User;
use App\Src\Users\Domain\UserValidationTrait;

class RegisterUser {

    use UserValidationTrait;

    public function __invoke(
        string $name,
        string $email,
        string $password,
        string $confirm_password,
    ): array{

        # Validar si password == c_password
        $this->isSamePassword($password, $confirm_password);

        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => bcrypt($password),
        ]);

        $response = [
            'token' => $user->createToken('e-commerce')->accessToken,
            'name'  => $user->name,
        ];

        return $response;

    }
}
