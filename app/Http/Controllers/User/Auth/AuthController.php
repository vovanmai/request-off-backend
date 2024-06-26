<?php


namespace App\Http\Controllers\User\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only([
            'code',
            'email',
            'password',
        ]);


        $user = Employee::join('companies', 'companies.id', '=', 'employees.company_id')
            ->where('companies.code', $credentials['code'])
            ->where('employees.email', $credentials['email'])
            ->first([
                'companies.status as company_status',
                'employees.id',
                'employees.name',
                'employees.status',
                'employees.email',
                'employees.password',
                'employees.created_at',
            ]);
sleep(5);
        if ($user) {
            if ($user->company_status === Company::STATUS_REGISTER) {
                return response()->error('Công ty chưa được duyệt. Vui lòng liên hệ quản trị hệ thống.', [], 403);
            }

            if ($user->company_status === Company::STATUS_BLOCKED) {
                return response()->error('Công ty đã bị vô hiệu . Vui lòng liên hệ quản trị hệ thống.', [], 403);
            }


            if ($user->status === Employee::STATUS_INACTIVE) {
                return response()->error('Tài khoản đã bị vô hiệu . Vui lòng liên hệ quản trị viên của công .', [], 403);
            }


            if (Hash::check($credentials['password'], $user->password)) {
                $tokenResult = $user->createToken(' access token', ['employee']);

                return response()->success([
                    'user' => $user,
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                ]);
            }
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
