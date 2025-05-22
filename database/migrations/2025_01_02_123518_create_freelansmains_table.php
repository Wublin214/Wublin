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
        Schema::create('freelansmains', function (Blueprint $table) {
            $table->id();
            $table->mediumText('ProjectTitle');
            $table->mediumText('ProjectDescription');
            $table->mediumText('TypeOfWebsite');
            $table->mediumText('DesignPreferences');
            $table->mediumText('FunctionalRequirements');
            $table->integer('Timeline');
            $table->integer('Budget');
            $table->mediumText('Content');
            $table->mediumText('SEOConsiderations');
            $table->mediumText('ContactInformation');
            $table->mediumText('status');
            $table->timestamps( );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelansmains');
    }
};
