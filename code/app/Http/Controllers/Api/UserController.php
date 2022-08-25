<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Src\Users\Application\DestroyUser;
use App\Src\Users\Application\RegisterUser;
use App\Src\Users\Application\SearchUser;
use App\Src\Users\Application\UpdateUser;
use Illuminate\Http\Request;

class UserController extends BaseController {

    public function index(Request $request, SearchUser $search) {
        $page  = $request->page ?? 1;
        $users = $search->paginate(page:$page);
        return UserResource::collection($users);

    }

    public function store(StoreUserRequest $request, RegisterUser $register) {
        $success = $register(
            $request->name,
            $request->email,
            $request->password,
            $request->c_password,
        );

        return $this->sendResponse($success, 'User register successfully.');

    }

    public function show(User $user) {
        return new UserResource($user);
    }

    public function update(StoreUserRequest $request, User $user, UpdateUser $update) {

        $user = $update($user, $request->validate());

        return new UserResource($user);
    }

    public function destroy(User $user, DestroyUser $destroy) {
        $destroy($user);
        return response(null, 204);
    }
}
