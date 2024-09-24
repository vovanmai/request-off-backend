<?php


namespace App\Services\User\Role;

use App\Models\Role;

class IndexService
{
    /**
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function handle(array $data)
    {
        $query = Role::query();

        if (filled($data['name'] ?? null)) {
            $query->where('name', 'like', "%{$data['name']}%");
        }

        return $query->where('company_id', auth()->user()->company_id)
            ->paginate($data['per_page'] ?? 10);
    }
}
