<?php

namespace App\Console\Commands;

use App\Contract\PostRepositoryInterface;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportPostCommand extends Command
{
    /**
     * 
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Posts from Feed Server ';

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
    public function handle(PostRepositoryInterface $postRepository)
    {
        $adminUser = User::where('name', 'admin')->first();
        $response = Http::get(config('feed.server'));

        if ($response->successful()) {
            $arrrayPost = json_decode($response->getBody());

            foreach ($arrrayPost->data as $post) {
                $postRepository->create([
                    'title' => $post->title,
                    'description' => $post->description,
                    'publication_date' => $post->publication_date
                ], $adminUser->id);
            }
        }
    }
}
