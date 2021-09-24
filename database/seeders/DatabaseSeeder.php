<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Fikri Omar',
            'username' => 'fikriomar16',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'is_super' => 1
        ]);
        Admin::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'is_super' => 1
        ]);
        \App\Models\Config::factory(1)->create();
        // \App\Models\User::factory(27)->create();
        \App\Models\Admin::factory(3)->create();
        \App\Models\Candidate::factory(3)->create();
    }
}
