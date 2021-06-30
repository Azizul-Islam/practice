<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        foreach($user->posts as $post){
            echo $post->title."<br>";
        }
    }
    public function store()
    {
        $user = User::find(1);
        $post = new Post(['title'=>'Post title 2','body'=>'post body here 2']);
        $user->posts()->save($post);
    }

    public function update()
    {
        $user = User::find(1);
        $user->posts()->whereId(1)->update(['title'=>'update title','body'=>'updated body']);
    }

    public function destroy()
    {
        $user = User::find(1);
        $user->posts()->where('id',1)->delete();
    }
}
