@extends('layouts.admin')

@section('content')

<h1>CATEGORIES</h1>

<div class="col-sm-4">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store'])!!}

        <div class="form-group">
        {!! Form::label('name', 'Category Name') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
                {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>


        {!!Form::close()!!}


</div>

<div class="col-sm-4">

    @if($categories) 
        <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                  
                    <th>Name</th>
                   
                    <th>Created at</th>
                    
                </tr>
                </thead>

                <tbody>

                    
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                    
                            <td><a href="{{route('categories.edit', ['id' => $category->id])}}">{{$category->name}}</a></td>
                           
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                            
                        </tr>

                        @endforeach
                 
      
                 </tbody>
         </table>
     @endif
</div>
@endsection