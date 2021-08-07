<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        "numero_commmande",
        "telephone",
        "customer_name",
        "user_id",
        "status",
        "total"
    ];

    public function drinks(){
        return $this->belongsToMany(Drink::class)->withPivot(['quantite']);
    }
}
