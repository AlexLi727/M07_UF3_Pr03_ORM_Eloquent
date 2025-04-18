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
        Schema::create('film_actor', function (Blueprint $table) {
            $table->unsignedBigInteger("film_id");
            $table->unsignedBigInteger("actor_id");
            $table->timestamps();
            $table->foreign("film_id")->references("id")->on("films");
            $table->foreign("actor_id")->references("id")->on("actors");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films_actors');
    }
};
