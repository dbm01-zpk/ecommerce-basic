<?php
namespace App\Src\Users\Application;

use App\Models\User;

class UpdateUser {
    public function __invoke(
        User $user,
        array $data
    ): User {

        $input             = $data;
        $input['password'] = bcrypt($input['password']);

        $user->name     = $input['name'];
        $user->password = $input['password'];

        $user->save();

        return $user;

    }
}
