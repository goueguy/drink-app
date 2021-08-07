<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drink;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\CategoryDrink;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['drinks'] = Drink::orderBy('id','desc')->with('category')->get();
        return view('admin.boissons.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryDrink::all();
        $fournisseurs = Fournisseur::all();
        return view('admin.boissons.create',compact('categories','fournisseurs'));
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
            'category'=>'required',
            'fournisseur'=>'required',
            'quantite'=>'required',
            'prix_unitaire'=>'required',
            'image'=>'required|image|mimes:png,jpeg,gif,tif|max:2048'
        ]);
        $newDrink = new Drink();
        $newDrink->name =$request->name;
        $newDrink->description =$request->description;
        $newDrink->category_drink_id =$request->category;
        $newDrink->fournisseur_id =$request->fournisseur;
        $newDrink->quantite =$request->quantite;
        $newDrink->prix_unitaire =$request->prix_unitaire;

        if($request->hasFile('image')){
            $fileNameWithExtension= $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName .'_'.time().'.'.$extension;
            $request->file('image')->move('uploads/boissons',$fileNameToStore);
        }else{
            $fileNameToStore = "default.png";
        }
        $newDrink->image =$fileNameToStore;
        $added = $newDrink->save();

        $response = ($added) ? [
            "status"=>"success",
            "message"=>"Boisson ajoutée"
        ]:[
            "status"=>"error",
            "message"=>"Boisson n a pas été ajoutée"
        ];
        return redirect()->route('admin.drinks')->with($response);


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
        $categories = CategoryDrink::all();
        $fournisseurs = Fournisseur::all();
        $drink = Drink::find($id);
        return view('admin.boissons.edit',compact('categories','fournisseurs','drink'));
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
            'description'=>'string|max:15',
            'category'=>'required',
            'fournisseur'=>'required',
            'quantite'=>'required',
            'prix_unitaire'=>'required',
            'image'=>'required|image|mimes:png,jpeg,gif,tif|max:2048'
        ]);
        $data = Drink::find($id);
        if($request->hasFile('image')){
            $fileNameWithExtension= $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName .'_'.time().'.'.$extension;
            $file = public_path()."/uploads/boissons/".$data->image;
            if(file_exists($file)){
                File::delete($file);
            }
            $request->file('image')->move('uploads/boissons',$fileNameToStore);
        }else{
            $fileNameToStore = $data->image;
        }
        $data->update([
            "name"=>$request->name,
            "description"=>$request->description,
            "category_drink_id"=>$request->category,
            "fournisseur_id"=>$request->fournisseur,
            "quantite"=>$request->quantite,
            "prix_unitaire"=>$request->prix_unitaire,
            "image"=>$fileNameToStore
        ]);
        $response = ($data) ? [
            "status"=>"success",
            "message"=>"Boisson modifiée"
        ]:[
            "status"=>"error",
            "message"=>"Boisson n a pas été modifiée"
        ];
        return redirect()->route('admin.drinks')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Drink::find($id);

        $delete = $data->delete();

        $file = public_path()."/uploads/boissons/".$data->file;
        if(file_exists($file)){
            File::delete($file);
        }

        $response = ($delete) ? [
            "status"=>"success",
            "message"=>"Boisson supprimée"
        ]:[
            "status"=>"error",
            "message"=>"Boisson n a pas été supprimée"
        ];
        return redirect()->route('admin.drinks')->with($response);
    }
}
