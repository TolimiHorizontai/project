@extends('layouts.admin')

@section('content')
    
<h1>Posts COMMENTS</h1>

@if(Session::has('deleted_comment'))

  <p class="bg-danger">{{session('deleted_comment')}}

@endif

<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cat</th>
        <th>Owner</th>
        <th>Title</th>
        <th>Photo</th>
        <th>Post body</td>
        <th>Created at</td>
        <th>Updated at</td>
      </tr>
    </thead>
    <tbody>

      @if($comments) 
        @foreach($comments as $comment)
          <tr>
              <td>{{$comment->id}}</td>
              <td>{{$comment->category ? $post->category->name : 'noCat'}}</td>
              <td><a href="{{route('posts.edit', ['id' => $post->id])}}">{{$post->user->name}}</a></td>
              <td>{{$comment->title}}</td>
              <td><img height="50" src="{{$post->photo ? asset($post->photo->file) :'http://Placehold.it/200x200'}}"></td>
              <td>{{str_limit($comment->body, 10)}}</td>
              <td>{{$comment->created_at->diffForHumans()}}</td>
              <td>{{$comment->updated_at->diffForHumans()}}</td>
              
          </tr>

        @endforeach
      @endif
      
    </tbody>
  </table>
@stop