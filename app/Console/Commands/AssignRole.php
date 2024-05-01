<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    protected $signature = 'user:assignrole {email} {role}';

    protected $description = 'Assign a role to a user with a specific email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("No user with the email {$email} found.");
            return;
        }

        $user->role = $role;
        $user->save();

        $this->info("The role {$role} has been assigned to {$email}.");
    }
}
