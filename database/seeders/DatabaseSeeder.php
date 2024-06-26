<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::create([
//            'name' => "Lionel vo",
//            'email' => "vovanmai.dt3@gmail.com",
//            'password' => "secret",
//        ]);

        $company = Company::create([
            'code' => "dpt",
            'name' => "DPT",
            'address' => "DPT",
            'status' => Company::STATUS_APPROVED,
        ]);
        Employee::create([
            'name' => "Lionel vo",
            'email' => "vovanmai.dt3@gmail.com",
            'password' => "secret",
            'company_id' => $company->id,
            'status' => Employee::STATUS_ACTIVE,
        ]);
    }
}
