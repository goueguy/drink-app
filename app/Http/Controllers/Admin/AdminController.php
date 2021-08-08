<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drink;
use App\Models\Client;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;

class AdminController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function dashboard(){
        $clients = Client::count();
        $drinks = Drink::count();
        $commandes = Commande::count();
        $fournisseurs = Fournisseur::count();
        return view('admin.dashboard',compact('clients','drinks','commandes','fournisseurs'));
    }
}
