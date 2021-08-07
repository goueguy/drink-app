<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryDrink;
use Illuminate\Http\Request;

class CategoryDrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = CategoryDrink::orderBy('id','desc')->get();
        return view('admin.categories-boissons.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories-boissons.create');
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

        $newCategory = new CategoryDrink();
        $newCategory->name = $request->name;
        $newCategory->description = $request->description;
        $newCategory->save();
        $response = ($newCategory) ? [
            "status"=>"success",
            "message"=>"Catégorie ajoutée"
        ]:[
            "status"=>"error",
            "message"=>"Catégorie n a pas été ajoutée"
        ];
        return redirect()->route('admin.categories')->with($response);
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
        $categorie = CategoryDrink::find($id);
        return view('admin.categories-boissons.edit',compact('categorie'));
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
        ]);
        $category = CategoryDrink::find($id);
        $category->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);

        $response = ($category) ? [
            "status"=>"success",
            "message"=>"Catégorie modifiée"
        ]:[
            "status"=>"error",
            "message"=>"Catégorie n'a pas été modifiée"
        ];
        return redirect()->route('admin.categories')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = CategoryDrink::find($id)->delete();
        $response = ($delete) ? [
            "status"=>"success",
            "message"=>"Catégorie supprimée"
        ]:[
            "status"=>"error",
            "message"=>"Catégorie n a pas été supprimée"
        ];
        return redirect()->route('admin.categories')->with($response);
    }
}
