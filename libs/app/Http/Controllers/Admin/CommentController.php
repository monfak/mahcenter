<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:comments-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $comments = Comment::with('article')->latest()->paginate();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $comment = Comment::with('article')->findOrFail($id);
        $comment->update(['seen_at' => now()]);
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $answer = Comment::create([
            'user_id'       => auth()->user()->id,
            'article_id'    => $comment->article_id,
            'ip'            => $request->ip(),
            'content'       => $request->input('content'),
            'parent_id'     => $comment->id,
            'status'        => Commect::APPROVED,
        ]);
        success();
        return redirect()->route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $comment = Comment::findorFail($id);

        if (isset($data['active'])) {
            $stat = $data['active'];
            $stat = ($stat == Comment::APPROVED ? Comment::APPROVED : Comment::REJECTED);
            $comment->status = $stat;
            $comment->save();
        }

        if ( isset($data['delete'] )) {
            $comment->delete();
        }

        success();
        return redirect()->route('admin.comments.index');
    }
}
