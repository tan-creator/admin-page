<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@runsystem.net',
            'password' => 'password', // password,
            'fullname' => 'Nguyễn Văn A',
            'code' => 10000,
            'area_code' => '+84',
            'phone_number' => '999999999',
            'day_of_birth' => '1998-01-01',
            'address' => '01 Đồng Khởi, Quận 1 TP HCM',
            'roles' => 'Admin',
            'levels' => 'Level 5',
            'status' => 'Active',
            'types' => 'Official',
            'note' => '',
            'department_id' => 1,
        ]);

        \App\Models\User::factory(5)->sequence(
            [
                'code' => 1001,
                'phone_number' => '199999999',
                'roles' => 'DM',
                'levels' => 'Level 5',
                'status' => 'Active',
                'types' => 'Official',
            ],
            [
                'code' => 1002,
                'phone_number' => '299999999',
                'roles' => 'DM',
                'levels' => 'Level 5',
                'status' => 'Active',
                'types' => 'Official',
            ],
            [
                'code' => 1003,
                'phone_number' => '399999999',
                'roles' => 'DM',
                'levels' => 'Level 5',
                'status' => 'Active',
                'types' => 'Official',
            ],
            [
                'code' => 1004,
                'phone_number' => '499999999',
                'roles' => 'DM',
                'levels' => 'Level 5',
                'status' => 'Active',
                'types' => 'Official',
            ],
            [
                'code' => 1005,
                'phone_number' => '599999999',
                'roles' => 'DM',
                'levels' => 'Level 5',
                'status' => 'Active',
                'types' => 'Official',
            ],
        )->create();

        \App\Models\User::factory(100)->create();
    }
}
