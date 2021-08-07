<?php

namespace App\Models;

use App\Models\Commande;
use App\Models\CategoryDrink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantite',
        'prix_unitaire',
        'fournisseur_id',
        'category_drink_id',
        'image'
    ];

    public function category(){
        return $this->belongsTo(CategoryDrink::class,'category_drink_id');
    }
    public function commandes(){
        return $this->belongsToMany(Commande::class);
    }
}
