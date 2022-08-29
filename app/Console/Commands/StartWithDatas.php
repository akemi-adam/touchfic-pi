<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

class StartWithDatas extends Command
{
    protected $signature = 'serve:seed {--admin}';

    protected $description = 'Start the server on port 8000 and run the essential seeders for the application';

    public function handle()
    {
        if ($this->confirm('Deseja rodar as seeders básicas?')) {
            $this->call('db:seed');
        }

        if ($this->hasOption('admin')) {
            $this->call('make:admin');
        }

        $this->call('serve');

        return 0;
    }
}
