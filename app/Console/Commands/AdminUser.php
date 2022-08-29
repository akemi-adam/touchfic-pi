<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AdminUser extends Command
{
    protected $signature = 'make:admin';
    
    protected $description = 'Create a admin in system';

    public function handle()
    {
        $name = $this->ask('Qual o seu nome?');
        
        $email = $this->ask('Qual o seu e-mail?');
        
        $password = $this->secret('Qual sua senha?');

        if ($this->confirm('Deseja finalizar a operação?')) {

            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'permission_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->info('Usuário criado com sucesso!');
            $this->newLine();

            return 0;
        }

        $this->info('A operação foi cancelada com êxito!');
        $this->newLine();

        return 0;
    }
}
