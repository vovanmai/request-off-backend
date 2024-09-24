<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => "Lionel vo",
            'email' => "vovanmai.dt3@gmail.com",
            'password' => "secret",
            'status' => Admin::STATUS_ACTIVE,
        ]);
        Admin::create([
            'name' => "Lionel vo",
            'email' => "ad@gmail.com",
            'password' => "secret",
            'status' => Admin::STATUS_ACTIVE,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $company = Company::create([
                'name' => "Company {$i}",
                'status' => Company::STATUS_APPROVED,
            ]);
            User::create([
                'company_id' => $company->id,
                'name' => "Lionel vo",
                'status' => User::STATUS_ACTIVE,
                'email' => "vovanmai.dt3@gmail.com",
                'password' => "secret{$i}",
            ]);
        }
    }
}
