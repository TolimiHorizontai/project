@extends('layouts.admin')

@section('content')

<h1> EDIT  CATEGORIES</h1>


<div class="col-sm-9">

        {!! Form::model($category, ['method'=>'PATCH', 'action'=> ['AdminCategoriesController@update', $category->id]])!!}

        <div class="form-group">
        {!! Form::label('name', 'Category Name') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>


      
        <div class="form-group">
                {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-3']) !!}
        </div>
        
        {!!Form::close()!!}


        {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminCategoriesController@destroy', $category->id]])!!}
        <div class="form-group">
                {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-3 pull-right']) !!}
        </div>
        {!!Form::close()!!}

</div>


@stop