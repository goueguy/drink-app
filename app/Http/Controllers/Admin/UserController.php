<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('id','desc')->get();
        return view('admin.users.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3',
            'lastname'=>'required|string|min:3',
            'password'=>'required|string|min:8',
            'email'=>'required|email|unique:users',
            'role'=>'required'
        ]);

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->lastname = $request->lastname;
        $newUser->password = Hash::make($request->password);
        $newUser->email = $request->email;
        $newUser->role_id= $request->role;
        $newUser->save();
        $response = ($newUser) ? [
            "status"=>"success",
            "message"=>"Utilisateur ajouté"
        ]:[
            "status"=>"error",
            "message"=>"Utilisateur n a pas été ajouté"
        ];
        return redirect()->route('admin.users')->with($response);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('admin.users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|min:3',
            'lastname'=>'required|string|min:3',
            'email'=>'required|email|unique:users,email,'.$id,
            'role'=>'required|string'
        ]);

        $update = User::find($id)->update([
            "name"=>$request->name,
            "lastname"=>$request->lastname,
            "email"=> $request->email,
            "role_id"=>$request->role
        ]);

        $response = ($update) ? [
            "status"=>"success",
            "message"=>"Utilisateur modifié"
        ]:[
            "status"=>"error",
            "message"=>"Utilisateur n a pas été modifié"
        ];
        return redirect()->route('admin.users')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id)->delete();

        $response = ($data) ? [
            "status"=>"success",
            "message"=>"Information a été suppriméé"
        ]:[
            "status"=>"error",
            "message"=>"Information n'a pas été suppriméé"
        ];

        return redirect()->route('admin.users')->with($response);
    }
}
