<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class PublishScheduled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the scheduled command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Article::whereDate('published_at', '<=', now())->scheduled()->update(['status' => Article::STATUS_PUBLISHED]);
    }
}
