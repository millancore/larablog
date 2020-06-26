<?php

namespace App\Http\Controllers;

use App\Contract\PostRepositoryInterface;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->middleware('auth')->only(['create', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate(['order' => 'in:asc,desc']);
        $order = $request->input('order') ?? 'desc';

        $posts = $this->postRepository->getAll($order);

        $posts->map(function ($item) {
            return $item->description = Str::of($item->description)
                   ->words(30, ' ...');
        });

        return view('welcome', [
            'posts' => $posts,
            'order' =>  $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreatePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        try {
            $this->postRepository->create(
                $request->all(),
                auth()->user()->id
            );
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return $this->restore($request);
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        if ($post = Redis::hgetall($slug)) {
            return view('posts.show', ['post' => (object) $post]);
        }

        $post = $this->postRepository->getBySlug($slug);

        if (is_null($post)) {
            return response()->view('posts.notfound', [], 404);
        }

        Redis::hmset($slug, $post->toArray());
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Restore unsave Post
     *
     * @param Request $request
     * @return void
     */
    private function restore(Request $request)
    {
        return view('posts.create', [
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ])->withErrors([
            'It has not been possible to save the publication, try again'
        ]);
    }
}
