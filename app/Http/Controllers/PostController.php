<?php

namespace App\Http\Controllers;

use App\Affiliation;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function first()
    {
        $affiliation = Affiliation::first();
        $affiliation['posts'] = $affiliation->posts;
        return mainResponse(true, __('okay'), $affiliation, [], 200);
    }

    public function like(Request $request)
    {
        $post = Post::query()->first();
        $post->like(auth('api')->id());
        return mainResponse(true, __('ok'), $post, [], 200);
    }
}
