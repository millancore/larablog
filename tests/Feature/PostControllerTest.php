<?php

namespace Tests\Feature;

use App\User;
use App\Model\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Tests\TestCase;

class PostControllerTest extends TestCase
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
        $this->assertEquals(
            $post->title,
            Arr::get($response->original->gatherData(), 'post')['title']
        );
        $this->assertEquals(
            $post->description,
            Arr::get($response->original->gatherData(), 'post')['description']);
        $response->assertViewIs('posts.show');
    }

    public function testNotFoundPostByInvalidSlug()
    {
        $response = $this->get('posts/this-is-an-invalid-slug');

        $response->assertStatus(404);
        $response->assertViewIs('posts.notfound');
    }

}