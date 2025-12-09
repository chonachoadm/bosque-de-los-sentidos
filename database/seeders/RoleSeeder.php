<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ["name" => "admin"],
            ["name" => "user"],
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $users = User::whereNull('role_id')->get();
        foreach ($users as $user) {
            if ($user->email === 'admin@admin.com') {
                $user->role_id = $adminRole?->id;
            } else {
                $user->role_id = $userRole?->id;
            }
            $user->save();
        }
    }
}
