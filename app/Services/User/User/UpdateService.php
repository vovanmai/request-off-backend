<?php


namespace App\Services\User\User;

use App\Exceptions\BadRequestException;
use App\Models\User;

class UpdateService
{

    /**
     * @param array $data
     * @return void
     */
    public function handle(int $id, array $data)
    {
        $user = User::query()->findOrFail($id);

        if ($user->id === auth()->id()) {
            throw new BadRequestException('Bạn không thể cập tài khoản chính bạn.');
        }

        $dataUpdate = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
        ];

        if (filled($data['password'] ?? null)) {
            $dataUpdate['password'] = bcrypt($data['password']);
        }

        User::where('id', $user->id)
            ->update($dataUpdate);
    }
}
