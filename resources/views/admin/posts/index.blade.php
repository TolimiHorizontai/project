@extends('layouts.admin')

@section('content')
    
<h1>Posts index</h1>

@if(Session::has('deleted_post'))

  <p class="bg-danger">{{session('deleted_post')}}

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

      @if($posts) 
        @foreach($posts as $post)
          <tr>
              <td>{{$post->id}}</td>
              <td>{{$post->category_id}}</td>
              <td>{{$post->user->name}}</td>
              <td>{{$post->title}}</td>
              <td><img height="50" src="{{$post->photo ? asset($post->photo->file) :'http://Placehold.it/200x200'}}""></td>
              <td>{{$post->body}}</td>
              <td>{{$post->created_at->diffForHumans()}}</td>
              <td>{{$post->updated_at->diffForHumans()}}</td>
              
          </tr>

        @endforeach
      @endif
      
    </tbody>
  </table>
@stop