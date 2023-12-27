<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    // create comment
    public function create()
    {
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }

    // delete comment
    public function delete($id)
    {
        $comment = Comment::find($id);
        if(Gate::denies('comment-delete', $comment)) {
        return back()->with('error', 'Unauthorize');
        }
        $comment->delete();
        return back();
    }

    // direct to edit page
    public function edit($id)
    {
        $data = Comment::find($id);

        return view('comments.edit', [
            'comment' => $data
        ]);
    }

    // update comment
    public function update(Request $request)
    {
        $validator = validator($request->all(), [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = [
            'content' => $request->comment,
        ];

        Comment::where('id',$request->comment_id)->update($data);

        return back()->with('info', 'Article Updated');
    }


    public function __construct()
    {
        $this->middleware('auth');
    }
}
