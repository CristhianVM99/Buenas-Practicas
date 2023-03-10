<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
// use App\Models\Documento;

class MoveFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folder:move {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para mover Archivos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $files = Storage::disk('local')->files($name);
        $this->info(count($files));
        if(count($files) > 0)
        {
            foreach ($files as $file) {
                if(Storage::exists($file))
                {
                    Storage::move($file,'public/'.$file);
                    $this->info($file.'  movido al directorio publico');
                }
            }
        }
        else{
            $this->info('No se encontraron archivos en el directorio: '.$name);
        }
        return Command::SUCCESS;
    }
}
