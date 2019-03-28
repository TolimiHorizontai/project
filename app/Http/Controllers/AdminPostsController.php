<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsEditRequest;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Photo;
use App\Post;
use App\Category;
use App\Comment;
use App\CommentReply;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $posts = Post::all();
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $input = $request->all();
        $user = Auth::user();
        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        $user->post()->create($input);
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        $comments = $post->comments;
    
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
        $post = Post::find($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        //
        $input = $request->all();
        $post = Post::findOrFail($id);

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalNAme();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        
        }
        
        $post->update($input);

        return redirect('/admin/posts');

        //kitas budas (tada nereikalingos eilutes su $post = ..):
        //Auth::user()->posts()->whereId($id)->first()->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //nustatom posta:
         $post = Post::findOrFail($id);
 
         //jei yra nuotrauka, ja istrinam is images
        if($post->photo){
        unlink(public_path($post->photo->file));
        }
         //istrinam visa posta:
         $post->delete();
 
         //sukuriam sesija zinutes atspausdinimui:
         Session::flash('deleted_post', 'The post has been deleted');
 
         return redirect('admin/posts');
     
    }

public function post($id){

    $categories = Category::all();
    $post=Post::find($id);
    $comments = $post->comments()->whereIsActive(1)->get();
   // $comments = Comment::all();
    $replies = CommentReply::all();
    //$replies = $comments->replies()->whereIsAcive(1)->get();
    return view('post', compact('post', 'categories', 'comments', 'replies'));
}

}
