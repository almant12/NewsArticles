<?php

namespace App\Console\Commands\Category;

use App\Models\Category;
use Illuminate\Console\Command;

class AddCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:category {name}';

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
        $name = $this->argument('name');

        if (Category::where('name', $name)->exists()) {
            $this->info('Category already exists!');
            return 1;
        }

        $category = Category::create(['name' => $name]);

        $this->info('Category added successfully!'.' ID='.$category->id);
        return 0;
    }
}
