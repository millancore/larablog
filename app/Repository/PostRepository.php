<?php

namespace App\Repository;

use App\Contract\PostRepositoryInterface;
use App\Model\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostRepository implements PostRepositoryInterface
{

    /**
     * Create new Post
     *
     * @param array $data
     * @param uuid $userId
     * @return void
     */
    public function create(array $data, string $userId)
    {
        $post = new Post;

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->slug = Str::slug($data['title'], '-');
        $post->user_id = $userId;
        $post->publication_date = !isset($data['publication_date']) ? Carbon::now() : $data['publication_date'];

        return $post->save();
    }

    /**
     * Get user Post
     *
     * @param uuid $userId
     * @return void
     */
    public function allByUser(string $userId)
    {
        return Post::where('user_id', $userId)
                    ->orderBy('publication_date', 'desc')
                    ->paginate(5);
    }

    /**
     * Get Post by Slug
     *
     * @param string $slug
     * @return void
     */
    public function getBySlug(string $slug)
    {
        return Post::where('slug', $slug)->first();
    }

    /**
     * All Post
     * 
     * @param string $publicationOrder
     * @return void
     */
    public function getAll(string $publicationOrder = 'desc')
    {
        return Post::orderBy('publication_date', $publicationOrder)
                    ->paginate(6);
    }
}
