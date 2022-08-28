<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
/* use Illuminate\Support\Facades\Artisan; */

class StartWithDatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the server on port 8000 and run the essential seeders for the application';

    /**
     * Executa as seeders do banco e inicia o servidor
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Deseja rodar as seeders básicas?')) {
            $this->call('db:seed');
        }
        $this->call('serve');
        return 0;
    }
}
