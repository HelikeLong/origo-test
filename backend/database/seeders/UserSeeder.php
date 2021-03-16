<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->user = 'admin';
        $user->password = (new BcryptHasher())->make('admin');
        $user->save();
    }
}
