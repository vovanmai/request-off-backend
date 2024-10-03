<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Role\StoreRequest;
use App\Jobs\TestJob;
use App\Models\User;
use App\Services\User\Role\IndexService;
use App\Services\User\Role\StoreService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->only([
            'name',
            'per_page',
            'sort',
            'order',
            'created_at_from',
            'created_at_to',
            'updated_at_from',
            'updated_at_to',
        ]);

        $result = resolve(IndexService::class)->handle($data);

        return response()->success($result);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $result = resolve(StoreService::class)->handle($data);

        return response()->success($result);
    }
}
