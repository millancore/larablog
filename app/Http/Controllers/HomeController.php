<?php

namespace App\Http\Controllers;

use App\Repository\PostRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $postRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postCollection = $this->postRepository->allByUser(
            auth()->user()->id
        );

        return view('home', ['posts' => $postCollection ]);
    }
}
