<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['clients'] = Client::orderBy('id','desc')->get();
        return view('admin.clients.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
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
            'email'=>'required|email|unique:clients',
            'telephone'=>'required'
        ]);

        $newClient = new Client();
        $newClient->name = $request->name;
        $newClient->lastname = $request->lastname;
        $newClient->email = $request->email;
        $newClient->telephone= $request->telephone;
        $newClient->save();
        $response = ($newClient) ? [
            "status"=>"success",
            "message"=>"Client ajouté"
        ]:[
            "status"=>"error",
            "message"=>"Client n a pas été ajouté"
        ];
        return redirect()->route('admin.clients')->with($response);
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
        $client = Client::find($id);
        return view('admin.clients.edit',compact('client'));
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
            'telephone'=>'required|string'
        ]);

        $update = Client::find($id)->update([
            "name"=>$request->name,
            "lastname"=>$request->lastname,
            "email"=> $request->email,
            "telephone"=>$request->telephone
        ]);

        $response = ($update) ? [
            "status"=>"success",
            "message"=>"Client modifié"
        ]:[
            "status"=>"error",
            "message"=>"Client n'a pas été modifié"
        ];
        return redirect()->route('admin.clients')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Client::find($id)->delete();

        $response = ($data) ? [
            "status"=>"success",
            "message"=>"Client a été supprimé"
        ]:[
            "status"=>"error",
            "message"=>"Client n'a pas été supprimé"
        ];

        return redirect()->route('admin.clients')->with($response);
    }
}
