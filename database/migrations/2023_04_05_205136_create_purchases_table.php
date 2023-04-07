<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('purchases')){
            Schema::create('purchases', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->string('buyername');
                $table->string('email');
                $table->integer('price');
                $table->foreignId('id_videogame')->constrained('videogames');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
