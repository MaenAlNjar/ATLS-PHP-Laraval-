<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ConvertPasswordsToHashed extends Command
{
    protected $signature = 'passwords:convert';

    protected $description = 'Convert existing passwords to hashed Bcrypt passwords';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('Passwords successfully converted to hashed Bcrypt passwords!');
    }
}
