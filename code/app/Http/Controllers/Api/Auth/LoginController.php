<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Src\Users\Application\LoginUser;
use Illuminate\Http\Request;

class LoginController extends BaseController {

    public function __invoke(Request $request, LoginUser $login) {

        $success = $login($request->email, $request->password);

        if ($success['success']) {
            return $this->sendResponse(
                $success['data'],
                'User login successfully.'
            );

        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);

        }

    }

}
