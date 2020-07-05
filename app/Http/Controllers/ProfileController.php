<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProfileController extends Controller
{

    public function find($user_id)
    {
        $user = User::find($user_id);
        $user['address'] = $user->profile->address;
//        return new UserResource($user);
        return mainResponse(true, __('ok'), $user, [], 200);
    }

}

