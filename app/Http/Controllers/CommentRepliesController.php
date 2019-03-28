<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\CommentReply;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Photo;
use App\Post;
use App\Category;



class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "it`s OK";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createReply(Request $request){

        $user = Auth::user();

        $data = [
            'comment_id'=> $request->comment_id,
            'is_active' => $user->is_active,
            'author'=> $user->name,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body
        ];

        CommentReply::create($data);

        $request->session()->flash('reply_message', 'Your reply has been submitted and is waiting moderation');

        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a comment by id:
        $comment = Comment::findOrFail($id);
        //link to comment and replies relationship(function in Comment.php replies()):
        $replies = $comment->replies;
        //return view:
        return view('admin.comments.replies.show', compact('replies'));

    //return "it works";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        CommentReply::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and delete:

        CommentReply::findOrFail($id)->delete();
        return redirect()->back();
    }
}
