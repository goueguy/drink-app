<?php

namespace App\Models;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryDrink extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function drinks(){
        return $this->hasMany(Drink::class);
    }
}
