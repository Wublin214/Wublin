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
            $table->mediumText('firstName');
            $table->mediumText('lastName');
            $table->string('email');
            $table->string('password');
            $table->string('gender');
            $table->string('imag')->nullable();
            $table->longText('text')->nullable();
            $table->longText('textEducation')->nullable();
            $table->string('phone')->nullable();
            $table->string('telegram')->nullable();
            $table->string('vk')->nullable();
            $table->integer('portfolio1')->nullable();
            $table->integer('portfolio2')->nullable();
            $table->integer('portfolio3')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
