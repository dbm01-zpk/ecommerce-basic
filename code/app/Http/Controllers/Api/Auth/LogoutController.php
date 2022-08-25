<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

class LogoutController extends BaseController {

    public function __invoke(Request $request) {
        foreach ($request->user()->tokens as $token) {
            $token->revoke();
        }
        return $this->sendResponse('Logged out successfully', 200);
    }

}
