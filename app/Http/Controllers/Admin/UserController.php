<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
//use App\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public  function  __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return  view('admin.users.index')->with('users',$users);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Implement the gates
        if (Gate::denies('edit-users')){
         return  redirect(route('admin.users.index'));
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user'  => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request);  sync() pass array of id

        //dd($request);
        $user->roles()->sync($request->roles);

        //update user information

        $user->name = $request->name;

        //$user->save();  //save the current user
        if ($user->save()){

            $request->session()->flash('success' ,'User has been updated');
            //$request->session()->flash('success' .$user->name .' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }

        return  redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //ddd($user);
        //Implement the gates
        if (Gate::denies('delete-users')){
            return  redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();
        return  redirect()->route('admin.users.index');


    }
}
