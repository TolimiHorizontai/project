@extends('layouts.admin')

@section('content')
    
<h1>Posts replies FROM replies.show</h1>

@if(Session::has('deleted_reply'))

  <p class="bg-danger">{{session('deleted_reply')}}

@endif


@if($replies) 
<table class="table">
    <thead>
      <tr>
        <th>Reply ID</th>            
        <th>Post ID</th>
        <th>Author</th>
        <th>Photo</th>
        <th>Reply body</th>      
        <th>View Post</th>   
        <th>Approve</th> 
        <th>Delete Reply</th> 
      </tr>
    </thead>
    <tbody>

   
        @foreach($replies as $reply)
          <tr>
              <td>{{$reply->id}}</td>                       
              <td>{{$reply->comment->post_id}}</td>
              <td>{{$reply->author}}</td>
              <td><img height="40" src="{{$reply->photo ? asset($reply->photo) :'http://Placehold.it/200x200'}}"></td>
              <td>{{str_limit($reply->body, 10)}}</td>                    
              <td><a href="{{route('home.post', ['id' => $reply->comment->post->id])}}">View Post</a></td>
             

             
              <td>
                @if($reply->is_active == 1)

                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]])!!}

                <input type="hidden" name="is_active" value=0>
              
                <div class="form-group">
                        {!! Form::submit('Un-approve', ['class'=>'btn btn-succes']) !!}
                </div>
      
                {!!Form::close()!!}

                 @else

                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]])!!}

                <input type="hidden" name="is_active" value=1>
        
                <div class="form-group">
                        {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                </div>
              
                {!!Form::close()!!}
        
                @endif
              </td>

              <td>

                  {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]])!!}

                  <input type="hidden" name="is_active" value=1>
          
                  <div class="form-group">
                          {!! Form::submit('DELETE Reply', ['class'=>'btn btn-danger']) !!}
                  </div>
                
                  {!!Form::close()!!}

              </td>

            </tr>
         @endforeach
    </tbody>
  </table>

   
  @else

  <p> <h1>No replies</h1> </p>
      
  @endif
@stop