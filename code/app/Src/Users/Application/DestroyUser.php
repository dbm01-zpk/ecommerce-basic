<?php
namespace App\Src\Users\Application;

use App\Models\User;

class DestroyUser {
    public function __invoke(
        User $user
    ): bool {

        $user->delete();

        return true;

    }
}
