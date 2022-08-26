<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::factory(10)->create();

        if (!User::whereEmail('admin@devel.loc')->exists()) {
            User::factory()->create([
                'name'  => 'admin',
                'email' => 'admin@devel.loc',
            ]);
        }
    }
}
