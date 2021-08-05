<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['permissions'] = Permission::orderBy('id','desc')->get();
        return view('admin.permissions.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
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
            'description'=>'string',
        ]);

        $newPermission = new Permission();
        $newPermission->name = $request->name;
        $newPermission->description = $request->description;
        $newPermission->save();
        $response = ($newPermission) ? [
            "status"=>"success",
            "message"=>"Permission ajouté"
        ]:[
            "status"=>"error",
            "message"=>"Permission n a pas été ajouté"
        ];
        return redirect()->route('admin.permissions')->with($response);
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
        $permission = Permission::find($id);
        return view('admin.permissions.edit',compact('permission'));
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
            "description"=>"required|string|min:3"
        ]);

        $update = Permission::find($id)->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        $response = ($update) ? [
            "status"=>"success",
            "message"=>"Permission modifiée"
        ]:[
            "status"=>"error",
            "message"=>"Permission n a pas été modifiée"
        ];
        return redirect()->route('admin.permissions')->with($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Permission::find($id)->delete();
        $response = ($delete) ? [
            "status"=>"success",
            "message"=>"Permission supprimée"
        ]:[
            "status"=>"error",
            "message"=>"Permission n a pas été supprimée"
        ];
        return redirect()->route('admin.permissions')->with($response);
    }
}
