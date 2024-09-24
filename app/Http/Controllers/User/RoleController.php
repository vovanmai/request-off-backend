<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\VerifyEmailRequest;
use App\Models\Company;
use App\Models\Admin;
use App\Models\User;
use App\Services\User\Role\IndexService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->only([
            'name',
        ]);

        $result = resolve(IndexService::class)->handle($data);

        return response()->success($result);
    }
}
