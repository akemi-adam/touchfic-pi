<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartWithDatas extends Command
{
    /** @var string $signature command signature */
    protected $signature = 'serve:seed';

    /** @var string $description command description */
    protected $description = 'Start the server on port 8000 and run the essential seeders for the application';

    /**
     * It runs the seeds in case the developer wants it and also asks if you want to create an admin user in the process. If so, the make:admin command is executed. Regardless of the responses, the server is started at the end of the process.
     *
     * @return int
     **/
    public function handle()
    {
        if ($this->confirm('Deseja rodar as seeders básicas?')) {
            $this->call('db:seed');
        }

        if ($this->confirm('Deseja criar uma usuário admin?')) {
            $this->call('make:admin');
        }

        $this->call('serve');

        return 0;
    }
}
