@extends('layouts.blog-post')

@section('content')

<h1> POSTS </h1>

<!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at}}</p>

                <hr>

                <!-- Preview Image -->
                @if($post->photo)
                <img class="img-responsive" src="{{asset($post->photo->file)}}" alt="">
                @else 
                <img class="img-responsive" src="{{'http://Placehold.it/200x200'}}" alt="">
                @endif
                <hr>

                <!-- Post Content -->
                <p class="lead">{{$post->body}}</p>

                <hr>

                    @if(Session::has('comment_message'))
                        {{session('comment_message')}}
                    @endif

                <!-- Blog Comments -->
                
                @if(Auth::check())

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                   
                        {!! Form::open(['method'=>'POST', 'action'=>'CommentController@store'])!!}

                        <input type="hidden" name="post_id" value="{{$post->id}}">

                        <div class="form-group">
                            {!! Form::label('body', 'Body') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                        </div>
                
                        <div class="form-group">
                            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
                        </div>
                
                
                        {!!Form::close()!!}
                </div>

                @endif

                <hr>

                <!-- Posted Comments -->

                @if(count($comments)>0)

                    @foreach($comments as $comment)

                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img height = "64" class="media-object" src="{{asset($comment->photo)}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                            </h4>
                        {{$comment->body}}


                        <!-- button doesn`t work for some reasons
                       <div class="comment-reply-container">
                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>-->
                       <hr>

                            <div class="comment-reply"> 
                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply'])!!}

                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
            
                                    <div class="form-group">
                                        {!! Form::label('body', 'Reply to comment:') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                                    </div>
                            
                                    <div class="form-group">
                                        {!! Form::submit('Reply Comment', ['class'=>'btn btn-info']) !!}
                                    </div>
                                                       
                                    {!!Form::close()!!}

                                    <hr>
                            </div>




                                    @if(count($comment->replies)>0)
                                    @foreach($comment->replies as $reply)

                                        @if($reply->is_active==1)

                                <!-- Nested Comment -->
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img height = "64" class="media-object" src="{{asset($reply->photo)}}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$reply->author}}
                                                <small>{{$reply->created_at->diffForHumans()}}</small>
                                            </h4>
                                           {{$reply->body}}
                                           <hr>
                                        </div>
                                    </div>

                                            @else 

                                            <h4> No active replies  </h4>

                                            @endif
                                        @endforeach
                                    </div>
                            
                        <!-- End Nested Comment -->

                        @endif
                        </div>
                    </div>

                    @endforeach

                @endif

              
@stop

@section('categories')

                        <div class="col-md-4">
                                  
                                    <table class="table">
                            
                                            <tbody>
                                                                            
                                                    <tr>
                                                
                                                        <td>{{$post->category->name}}</td>                                                       
                                                        
                                                    </tr>                                 
                                             </tbody>
                                     </table>
                                
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled">

                                @foreach($categories as $category)
                                    <li><a href="#" >{{$category->name}}</a>
                                    </li>
                                @endforeach
                                
                            </ul>
                        </div>
                    

@stop

@section('scripts')

<script>

$(".comment-reply").click(function(){

    $(this).next().slideToggle("slow"); 
});



</script>
@stop