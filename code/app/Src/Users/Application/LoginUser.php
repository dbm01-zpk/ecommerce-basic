<?php
namespace App\Src\Users\Application;

use App\Models\User;
use App\Src\Users\Domain\UserValidationTrait;
use Illuminate\Support\Facades\Auth;

class LoginUser {

    use UserValidationTrait;

    public function __invoke(
        string $email,
        string $password,
    ): array{

        $flag_success = false;
        $data         = [];

        # Validar login
        try {
            $this->invalidAttempt($email, $password);
        } catch (\Throwable$th) {
            $flag_success = true;
        }

        #Construct response
        if ($flag_success) {
            $user          = Auth::user();
            $data['token'] = $user->createToken('e-commerce')->accessToken;
            $data['name']  = $user->name;
        }

        return [
            'data'    => $data,
            'success' => $flag_success,
        ];

    }
}
