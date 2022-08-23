<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController {

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(StoreUserRequest $request) {

        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user              = User::create($input);
        $success['token']  = $user->createToken('e-commerce')->accessToken;
        $success['name']   = $user->name;

        return $this->sendResponse($success, 'User register successfully.');

    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request) {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user             = Auth::user();
            $success['token'] = $user->createToken('e-commerce')->accessToken;
            $success['name']  = $user->name;
            return $this->sendResponse($success, 'User login successfully.');

        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);

        }

    }

}
