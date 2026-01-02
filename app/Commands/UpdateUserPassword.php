<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\UserModel;

class UpdateUserPassword extends BaseCommand
{
    protected $group       = 'User';
    protected $name        = 'user:update-password';
    protected $description = 'Update a user password via CLI';

    public function run(array $params)
    {
        $email = CLI::prompt('Enter user email');
        $password = CLI::prompt(
            'Enter new password',
            null,
            'required'
        );

        $userModel = new UserModel();

        $user = $userModel->where('email', $email)->first();

        if (! $user) {
            CLI::error('User not found');
            return;
        }

        $userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        CLI::write('Password updated successfully!', 'green');
    }
}
