@extends('layouts.admin')

@section ('content')

<h1> admin/users/index</h1>

@if(Session::has('deleted_user'))

  <p class="bg-danger">{{session('deleted_user')}}

@endif

<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <td>Photo</td>
        <th>Name</th>
        <th>Email</th>
        <th>Statuss</th>
        <th>Created at</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>

      @if($users) 
        @foreach($users as $user)
          <tr>
              <td>{{$user->id}}</td>
              <td>
                <img height="50" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt=""> 
              </td>
              <td><a href="{{route('users.edit', ['id' => $user->id])}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
              <td>{{$user->created_at->diffForHumans()}}</td>
              <td>{{$user->role->name}}</td>
          </tr>

        @endforeach
      @endif
      
    </tbody>
  </table>

@endsection