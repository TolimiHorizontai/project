@extends('layouts.admin')

@section('content')
    
<h1>Posts COMMENTS from Comments.INDEX</h1>

@if(Session::has('deleted_comment'))

  <p class="bg-danger">{{session('deleted_comment')}}

@endif

<table class="table">
    <thead>
      <tr>
        <th>ID</th>     
        <th>Author</th>
        <th>Photo</th>
        <th>Email</th>
        <th>Comment body</th>             
        <th>View Post</th>
        <th>View Replies</th>
        <th>Approve</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      @if($comments) 
        @foreach($comments as $comment)
          <tr>
              <td>{{$comment->id}}</td>              
              <td>{{$comment->author}}</td>
              <td><img height="40" src="{{$comment->photo ? asset($comment->photo) :'http://Placehold.it/200x200'}}"></td>
              <td>{{str_limit($comment->email, 10)}}</td>
              <td>{{str_limit($comment->body, 10)}}</td>                    
              <td><a href="{{route('home.post', ['id' => $comment->post_id])}}">View Post</a></td>
              <td><a href="{{route('replies.show', ['id' => $comment->id])}}">View Replies</a></td>
              <td>
                @if($comment->is_active == 1)

                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentController@update', $comment->id]])!!}

                <input type="hidden" name="is_active" value=0>
              
                <div class="form-group">
                        {!! Form::submit('Un-approve', ['class'=>'btn btn-succes']) !!}
                </div>
      
                {!!Form::close()!!}

                @else

                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentController@update', $comment->id]])!!}

                <input type="hidden" name="is_active" value=1>
        
                <div class="form-group">
                        {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                </div>
              
                {!!Form::close()!!}
        
                @endif
              </td>

              <td>

                  {!! Form::open(['method'=>'DELETE', 'action'=>['CommentController@destroy', $comment->id]])!!}

                  <input type="hidden" name="is_active" value=1>
          
                  <div class="form-group">
                          {!! Form::submit('DELETE', ['class'=>'btn btn-danger']) !!}
                  </div>
                
                  {!!Form::close()!!}

              </td>

            </tr>
        @endforeach  
    </tbody>
  </table>

@else

  <p> <h1>No comments</h1> </p>


  @endif
      
@stop