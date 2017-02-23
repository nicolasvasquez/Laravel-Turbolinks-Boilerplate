<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@admin.cl',
            'password' => bcrypt('123')
        ]);

        if (! $user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
}
