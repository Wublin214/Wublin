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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->mediumText('FirstName');
            $table->mediumText('LastName');
            $table->string('Email');
            $table->string('Password');
            $table->string('Gender');
            $table->string('imag')->nullable();
            $table->longText('Text')->nullable();
            $table->integer('portfolio1')->nullable();
            $table->integer('portfolio2')->nullable();
            $table->integer('portfolio3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
