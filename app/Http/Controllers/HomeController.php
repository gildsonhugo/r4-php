<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comments = Comment::select('*')->orderBy('updated_at', 'DESC')->get();
        return view('home', ['comments' => $comments]);
    }

    /**
     * Show the profile view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(){
        return view('profile');
    }

}
