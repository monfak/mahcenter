<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return Response
     */
    public function store(Article $article, CommentRequest $request)
    {
        $commentData = [
            'ip'            => $request->ip(),
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'content'       => $request->input('content'),
            'parent_id'     => $request->input('parent_id', null),
            'status'        => Comment::PENDING,
        ];
        if(auth()->check()) {
            $user = auth()->user();
            $commentData = array_merge($commentData, [
                'user_id'       => $user->id,
                'name'          => $user->name,
                'email'         => $user->email,
            ]);
        }
        $comment = $article->comments()->create($commentData);
        success('از نظر شما سپاسگزاریم. نظر شما برای تایید مدیر ارسال شده است.');
        return redirect()->route($article->id > 147 ? 'frontend.blog.show' : 'articles.show', $article->slug);
    }
}
