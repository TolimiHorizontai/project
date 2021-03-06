<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Photo;
use App\Post;

use App\Http\Controllers\File;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Collection;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    $users = User::all();
     
    return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //duomenu issaugojimui funkcijos:
        //users:
        //User::create($request->all());
        //return redirect('/admin/users');

        if(trim($request->password)==''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        
        }


        //photos:

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        //password encryption (pakeista del edit):
        //$input['password'] = bcrypt($request->password);
        
        //user creation
        User::create($input);

        return redirect('/admin/users');
        
        //if($request->file('photo_id')){
       //     return "photo exists";
       // }

        //return view('admin.users.index');
       // return $request->all();
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
        return view('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = User::find($id);
        $roles = Role::pluck('name', 'id')->all(); 
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
    

        
        if(trim($request->password)==''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        
        }

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalNAme();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        
        }
        
        $user->update($input);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //nustatom useri:
        $user = User::findOrFail($id);

        //surandam sasaja su paveiksleliu ir unlinkinam - neveikia kazkas:

       // $usersImage = public_path("/{$user->photo->file}"); 
       // if (file_exists($usersImage)) { 
        //    unlink($usersImage);
       // }

       unlink(public_path($user->photo->file));

        //istrinam useri:
        $user->delete();

        //sukuriam sesija zinutes atspausdinimui:
        Session::flash('deleted_user', 'The user has been deleted');

        return redirect('admin/users');
    }
}
