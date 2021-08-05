<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fournisseurs'] = Fournisseur::orderBy('id','desc')->get();
        return view('admin.fournisseurs.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fournisseurs.create');
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
            'telephone'=>'required|string|min:8',
            'localisation'=>'required|string',
            'email'=>'nullable|email|unique:fournisseurs'
        ]);

        $newFournisseur = new Fournisseur();
        $newFournisseur->name = $request->name;
        $newFournisseur->telephone = $request->telephone;
        $newFournisseur->localisation = $request->localisation;
        $newFournisseur->email = $request->email;
        $newFournisseur->save();
        $response = ($newFournisseur) ? [
            "status"=>"success",
            "message"=>"Fournisseur ajouté"
        ]:[
            "status"=>"error",
            "message"=>"Fournisseur n a pas été ajouté"
        ];
        return redirect()->route('admin.fournisseurs')->with($response);
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
        $fournisseur = Fournisseur::find($id);
        return view('admin.fournisseurs.edit',compact('fournisseur'));
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
            'telephone'=>'required|string|min:8',
            'localisation'=>'required|string',
            'email'=>'nullable|email|unique:fournisseurs,id,'.$id
        ]);
        $data = Fournisseur::find($id);
        $update = $data->update([
            'name'=>$request->name,
            'telephone'=>$request->telephone,
            'localisation'=>$request->localisation,
            'email'=>$request->email
        ]);

        $response = ($update) ? [
            "status"=>"success",
            "message"=>"Fournisseur modifié"
        ]:[
            "status"=>"error",
            "message"=>"Fournisseur n a pas été modifié"
        ];
        return redirect()->route('admin.fournisseurs')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Fournisseur::find($id)->delete();
        $response = ($delete) ? [
            "status"=>"success",
            "message"=>"Fournisseur supprimé"
        ]:[
            "status"=>"error",
            "message"=>"Fournisseur n a pas été supprimé"
        ];
        return redirect()->route('admin.fournisseurs')->with($response);
    }
}
