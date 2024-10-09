<?php


namespace App\Services\User\User;

use App\Models\User;

class StoreService
{
    /**
     * @param array $data
     * @return User
     */
    public function handle(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'company_id' => auth()->user()->company_id,
            'role_id' => $data['role_id'],
            'status' => User::STATUS_ACTIVE,
        ]);

        return $user;
    }
}
