<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Repository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{   
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->middleware('auth')->only(['create', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();

        $posts->map(function($item){
            return $item->description = Str::of($item->description)->words(30, ' ...');
        });

        return view('welcome', ['posts' => $posts]);
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
     * @param  \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       $post = $this->postRepository->create(
           $request->all(),
           auth()->user()->id
        );
        
        if(!$post) {
            
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
        $post = $this->postRepository->getBySlug($slug);

        if(is_null($post)) {
            return view('posts.notfound');
        }

        return view('posts.show', ['post' => $post]);
    }

}
