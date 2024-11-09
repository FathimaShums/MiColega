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
        Schema::create('Skills', function (Blueprint $table) {
            $table->id();
            $table->string('skill_name'); // Add a column for the skill name
        $table->unsignedBigInteger('category_id'); // Foreign key column
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('Category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Skills');
    }
};
