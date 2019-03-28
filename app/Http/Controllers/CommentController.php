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


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $comments = Comment::all();
        return  view('admin.comments.index', compact('comments'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //komentaru saugojima susiesim su auth(), kad useriams nereiketu ivedineti papildomu lauku
        //apie save, o visa reikalinga info mums surastu auth(), kartu tai reiskia, kad komentuoti gales tik isilogine,
        // taigi:

        //isivedam user:
        $user = Auth::user();

        $data = [
            'post_id'=> $request->post_id,
            'is_active' => $user->is_active,
            'author'=> $user->name,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body
        ];

        Comment::create($data);

        $request->session()->flash('comment_message', 'Your message has been submitted and is waiting moderation');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a post by id:
        $post = Post::findOrFail($id);
        //link to comment and post relationship(function in Post.php comments()):
        $comments = $post->comments;
        //return view:
    return view('admin.comments.show', compact('comments'));



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
        Comment::findOrFail($id)->update($request->all());
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
        //
        Comment::findOrFail($id)->delete();
        return redirect()->back();

    }
}
