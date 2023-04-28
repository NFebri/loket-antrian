<?php

namespace App\Database\Seeds;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['email' => 'loket1@example.com', 'username' => 'loket1', 'password' => 'password'],
            ['email' => 'loket2@example.com', 'username' => 'loket2', 'password' => 'password'],
            ['email' => 'loket3@example.com', 'username' => 'loket3', 'password' => 'password'],
            ['email' => 'loket4@example.com', 'username' => 'loket4', 'password' => 'password']
        ];

        foreach ($users as $user) {
            $new_user = new User($user);
            model(UserModel::class)->save($new_user->activate());
        }

    }
}
