<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\Role\IndexService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->only([
            'name',
            'per_page',
        ]);

        $result = resolve(IndexService::class)->handle($data);

        return response()->success($result);
    }
}
