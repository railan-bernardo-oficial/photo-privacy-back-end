<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function homePosts(){
        $posts = Post::take(4)->get();

        return ApiResponse::success("posts", $posts->all());
    }

    public function create(Request $request){
        $post = new Post();

        $post->user_id = auth()->user()->id;
        $post->content = $request->content;
        $post->status = $request->status ?? "draft";
        $post->is_subscriber_only = $request->is_subscriber_only ? true : false;

        if(!$post->save()){
            return  ApiResponse::error("Erro ao criar postagem", [], 400);
        }

        return ApiResponse::success("Poste criado com sucesso", [$post], 201);
    }
}
