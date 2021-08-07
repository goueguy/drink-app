<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drink;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data['commandes'] = Commande::orderBy('id','desc')->with('boissons')->get();
        $data['commandes'] = Commande::orderBy('id','desc')->get();
        return view('admin.commandes.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drinks = Drink::all();
        return view('admin.commandes.create',compact('drinks'));
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
            'telephone'=>'required|string',
            'quantites'=>'required',
            'boissons'=>'required'
        ]);
        $newOrder = new Commande();
        //custom format of facture number
        $nextNumber = Commande::pluck('id')->last()+1;
         //dd( $nextNumber = Facture::pluck('id'));
        $numero_commande = "CMD".'-'.sprintf('%04d',$nextNumber)."-".date('Y');
        $newOrder->numero_commande =  $numero_commande;
        $newOrder->customer_name = $request->name;
        $newOrder->telephone = $request->telephone;
        $newOrder->user_id = Auth::user()->id;
        $newOrder->status = "validée";
        $boissons = $request->input('boissons',[]);
        $quantites = $request->input('quantites',[]);

        $newOrder->save();
        $update = $this->getTableData($boissons,$quantites,$newOrder);
        // $dataDrink = [];
        // $amount = 0;
        // for($i=0; $i < count($boissons); $i++){
        //     $dataDrink= DB::table('drinks')->where('id',$boissons[$i])->first();
        //     DB::table('drinks')->where('id',$boissons[$i])->decrement('quantite',$quantites[$i]);
        //     if($boissons[$i] != ""){
        //         $newOrder->drinks()->attach($boissons[$i],['quantite'=>$quantites[$i]]);
        //     }
        //     //dd($dataDrink->prix_unitaire);
        //     $amount += $quantites[$i] * $dataDrink->prix_unitaire;
        // }

        // $newOrder->total = $amount;
        // $added = $newOrder->save();

        $response = ($update) ? [
            "status"=>"success",
            "message"=>"Commande ajoutée"
        ]:[
            "status"=>"error",
            "message"=>"Commande n a pas été ajoutée"
        ];
        return redirect()->route('admin.commandes')->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::find($id);
        $drinks = Drink::all();
        return view('admin.commandes.show',compact('drinks','commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commande = Commande::find($id);
        $drinks = Drink::all();
        return view('admin.commandes.edit',compact('drinks','commande'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commande = Commande::find($id);
        $commande->delete();
        $delete = $commande->drinks()->detach();
        $response = ($delete) ? [
            "status"=>"success",
            "message"=>"Commande supprimée"
        ]:[
            "status"=>"error",
            "message"=>"Commande n a pas été supprimée"
        ];
        return redirect()->route('admin.commandes')->with($response);
    }
    public function getTableData($boissons,$quantites,$newOrder){
        $dataDrink = [];
        $amount = 0;
        for($i=0; $i < count($boissons); $i++){
            $dataDrink= DB::table('drinks')->where('id',$boissons[$i])->first();
            DB::table('drinks')->where('id',$boissons[$i])->decrement('quantite',$quantites[$i]);
            if($boissons[$i] != ""){
                $newOrder->drinks()->attach($boissons[$i],['quantite'=>$quantites[$i]]);
            }
            //dd($dataDrink->prix_unitaire);
            $amount += $quantites[$i] * $dataDrink->prix_unitaire;
        }
        return Commande::where('id',$newOrder->id)->update(['total'=>$amount]);
    }
    public function changeStatus($id){
        $update = Commande::find($id)->update(['status'=>'annulée']);
        $response = ($update) ? [
            "status"=>"success",
            "message"=>"Commande annulée"
        ]:[
            "status"=>"error",
            "message"=>"Commande n'a pas été annulée"
        ];
        return redirect()->route('admin.commandes')->with($response);
    }
}
