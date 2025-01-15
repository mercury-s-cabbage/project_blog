<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Post;

class PublishPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-posts';

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
        $posts = Post::where('publish_at', '<=', now())
                    ->where('is_published', false)
                    ->update(['is_published' => true]);

        $this->info("Published $posts posts.");
    }
}
