<?php


namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\Company;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only([
            'email',
            'password',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        // Kiểm tra thông tin đăng nhập
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            $token = $admin->createToken('Admin Access Token')->accessToken;

            return response()->json([
                'access_token' => $token,
                'admin' => $admin
            ]);
        }

        return response()->error('Thông tin đăng nhập không đúng.', [], 401);
    }

    public function logout()
    {
        $user = auth()->user();

        $user->token()->revoke();

        return response()->success();
    }
}
