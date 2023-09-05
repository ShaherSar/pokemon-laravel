<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('pokedex_number');
            $table->string('image_name');
            $table->unsignedBigInteger('generation');
            $table->unsignedBigInteger('evolution_stage');
            $table->boolean('evolved');
            $table->unsignedBigInteger('family_id')->nullable()->default(NULL);
            $table->boolean('cross_gen')->default(false);
            $table->string('type_1');
            $table->string('type_2');
            $table->string('weather_1');
            $table->string('weather_2');
            $table->unsignedBigInteger('stats_total');
            $table->unsignedBigInteger('stats_attack');
            $table->unsignedBigInteger('stats_defend');
            $table->unsignedBigInteger('stats_stamina');
            $table->boolean('legendary')->default(0);
            $table->boolean('aquireable')->default(0);
            $table->boolean('spawns')->default(0);
            $table->boolean('regional')->default(0);
            $table->unsignedBigInteger('hatchable');
            $table->boolean('shiny');
            $table->boolean('nest');
            $table->boolean('new');
            $table->boolean('not_gettable');
            $table->boolean('future_evolve');
            $table->unsignedBigInteger('cp_40');
            $table->unsignedBigInteger('cp_39');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
