<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_role = Role::create([ 'name' => 'User', 'description' => 'Role Untuk User MC WEDDING' ]);
        $admin_role = Role::create([ 'name' => 'Admin', 'description' => 'Role Untuk Admin MC WEDDING' ]);
        $owner_role = Role::create([ 'name' => 'Owner', 'description' => 'Role Untuk Owner MC WEDDING' ]);

        $user = User::create([
            'role_id'           => $user_role->id,
            'name'              => 'User MC Wedding',
            'email'             => 'user@mcwedding.com',
            'password'          => Hash::make('password'),
            'premium_flag'      => 0,
            'identity_path'     => null
        ]);

        $owner = User::create([
            'role_id'           => $owner_role->id,
            'name'              => 'Owner MC Wedding',
            'email'             => 'owner@mcwedding.com',
            'password'          => Hash::make('password'),
            'premium_flag'      => 0,
            'identity_path'     => null
        ]);

        $admin = User::create([
            'role_id'           => $admin_role->id,
            'name'              => 'Admin MC Wedding',
            'email'             => 'admin@mcwedding.com',
            'password'          => Hash::make('password'),
            'premium_flag'      => 0,
            'identity_path'     => null
        ]);
    }
}
