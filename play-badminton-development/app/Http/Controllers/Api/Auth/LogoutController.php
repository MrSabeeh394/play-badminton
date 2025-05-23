<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LogoutController extends Controller
{
    public function store(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out.'], 200);
    }
}
