<?php

use App\Models\Drink;
use App\Models\Commande;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandeDrink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_drink', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Commande::class);
            $table->foreignIdFor(Drink::class);
            $table->integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_drink');
    }
}
