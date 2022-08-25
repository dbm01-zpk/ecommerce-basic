<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\StoreUserRequest;
use App\Src\Users\Application\RegisterUser;

class RegisterController extends BaseController {

    public function __invoke(StoreUserRequest $request, RegisterUser $register) {

        $success = $register(
            $request->name,
            $request->email,
            $request->password,
            $request->c_password,
        );

        return $this->sendResponse($success, 'User register successfully.');

    }

}
