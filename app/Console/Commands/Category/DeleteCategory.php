<?php

namespace App\Console\Commands\Category;

use App\Models\Category;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        if(!Category::where('id',$id)->exists()){
            $this->info('Category not found!');
            return 1;
        }else{
            Category::where('id',$id)->delete();
            $this->info('Category deleted successfully');
            return 0;
            //bobe
        }
    }
}
