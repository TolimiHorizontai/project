@extends('layouts.admin')

@section('content')
    
<h1>Posts create</h1>



{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true])!!}

    <div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category') !!}
        {!! Form::select('category_id', array(0 => 'review', 1 => 'opinion'),null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Post text') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('photo_id', 'Photo') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>

{!!Form::close()!!}




<div class='row'>
@include('includes.form_error')
</div>

@stop