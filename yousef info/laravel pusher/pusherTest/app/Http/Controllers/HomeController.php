<?php

namespace App\Http\Controllers;

use App\Events\newNotification;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::with(['comments' => function($q)
        {
            $q->select('id','post_id','comment');// must be choise forign_key in select to return value
        }
    ])->get();
        // $posts=Post::with('comments')->get();
   // dd($posts);
        return view('home',compact('posts'));
    }

    public function saveComment(Request $request)
    {
        $posts=Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->post_content,
        ]);
        $data = [
            'user_id' =>  Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->post_content,
        ];
        event(new newNotification($data));
       return redirect()->back()->with(['success' => 'comment Created']);
    }
}
