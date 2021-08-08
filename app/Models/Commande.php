<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        "numero_commmande",
        "user_id",
        "status",
        "total",
        "client_id"
    ];

    public function drinks(){
        return $this->belongsToMany(Drink::class)->withPivot(['quantite']);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
