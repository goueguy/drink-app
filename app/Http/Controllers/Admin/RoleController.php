<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::orderBy('id','desc')->get();
        return view('admin.roles.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'description'=>'string|max:15',
        ]);

        $newRole = new Role();
        $newRole->name = $request->name;
        $newRole->description = $request->description;
        $newRole->save();
        $response = ($newRole) ? [
            "status"=>"success",
            "message"=>"Rôle ajouté"
        ]:[
            "status"=>"error",
            "message"=>"Rôle n a pas été ajouté"
        ];
        return redirect()->route('admin.roles')->with($response);
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
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
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
            'description'=>"required|string|min:3",
            'permissions'=>"required"
        ]);
        $role = Role::find($id);
        $role->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        $role->permissions()->sync($request->permissions);
        $response = ($role) ? [
            "status"=>"success",
            "message"=>"Rôle modifié"
        ]:[
            "status"=>"error",
            "message"=>"Rôle n a pas été modifié"
        ];
        return redirect()->route('admin.roles')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Role::find($id)->permissions()->detach();
        Role::find($id)->delete();
        $response = ($delete) ? [
            "status"=>"success",
            "message"=>"Rôle supprimé"
        ]:[
            "status"=>"error",
            "message"=>"Rôle n a pas été supprimé"
        ];
        return redirect()->route('admin.roles')->with($response);
    }


}
