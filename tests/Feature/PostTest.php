<?php

namespace Tests\Feature;

use App\User;
use App\Model\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateNewPost()
    {
        $user = factory(User::class)->create();
        
        $response =  $this->actingAs($user)->post('posts', [
            'title' =>  'newTitle',
            'description' => 'lorem ipsom',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('home');
    }

    public function testGetPostBySlug()
    {
        $post = factory(Post::class)->create();

        $response = $this->get('posts/'.$post->slug);

        $response->assertStatus(200);
        $response->assertViewIs('posts.show');
    }

    public function testNotFoundPostByInvalidSlug()
    {
        $response = $this->get('posts/this-is-an-invalid-slug');

        $response->assertStatus(404);
        $response->assertViewIs('posts.notfound');
    }

}