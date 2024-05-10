<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $user, $post;

    public function __construct()
    {
        $this->user = new User;
        $this->post = new Post;
    }

    public function dashboard()
    {
        $posts = $this->post->all();

        return view('userpages.dashboard', compact('posts'));
    }
}
