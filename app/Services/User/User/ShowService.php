<?php


namespace App\Services\User\User;

use App\Models\Role;
use App\Models\User;

class ShowService
{

    /**
     * @param int $id
     * @return Role
     */
    public function handle(int $id): User
    {
        $user = User::query()->with('role:id,name')->findOrFail($id);

        return $user;
    }
}
