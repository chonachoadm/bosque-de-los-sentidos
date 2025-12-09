<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios que no tienen perfil
        $users = User::whereDoesntHave('profile')->get();

        foreach ($users as $user) {
            Profile::factory()
                ->for($user)
                ->create();
        }
    }
}
