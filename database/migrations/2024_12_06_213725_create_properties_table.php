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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('category');
            $table->string('image');
            $table->text('description');
            $table->string('address');
            $table->enum('status', ['occupe', 'vacant']);
            $table->decimal('dimensions', 8, 2)->nullable();
            $table->integer('nombre_chambres')->default(0);
            $table->json('dimensions_chambres')->nullable();
            $table->json('images_chambres')->nullable();
            $table->integer('nombre_toilets')->default(0);
            $table->integer('nombre_balcons')->default(0);
            $table->integer('nombre_spacesVerts')->default(0);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
