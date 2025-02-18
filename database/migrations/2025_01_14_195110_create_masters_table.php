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
        Schema::create('masters', function (Blueprint $table) {

            $table->id();
            $table->mediumText('firstName')->nullable();
            $table->mediumText('lastName')->nullable();
            $table->mediumText('email')->nullable();
            $table->mediumText('password')->nullable();
            $table->mediumText('gender')->nullable();
            $table->mediumText('imag')->nullable();
            $table->mediumText('text')->nullable();
            $table->timestamps( );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
