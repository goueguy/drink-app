<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "lastname",
        "email",
        "telephone"
    ];
    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
