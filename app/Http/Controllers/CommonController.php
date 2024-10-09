<?php


namespace App\Http\Controllers;

use App\Http\Requests\Common\CreateFileRequest;
use App\Services\Common\CreateFileService;

class CommonController extends Controller
{
    public function createFile(CreateFileRequest $request)
    {
        $data = $request->validated();

        $result = resolve(CreateFileService::class)->handle($data);

        return response()->success($result);
    }
}
