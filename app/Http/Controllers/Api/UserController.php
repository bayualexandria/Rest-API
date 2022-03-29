<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(User $user, Request $request)
    {
        $user->update([
            'name' => $request->name ? $request->name : $user->name,
        ]);

        return response()->json(['data' => $user, 'message' => 'Data has been updated!'], 200);
    }
}
