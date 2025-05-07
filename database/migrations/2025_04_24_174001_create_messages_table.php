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

        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->text('message');


                $table->foreignId('client_id')
                    ->constrained('clients')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignId('master_id')
                    ->constrained('masters')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignId('chat_id')
                    ->constrained('chats')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->string('user_type');
                $table->timestamps();


                $table->index(['chat_id', 'user_type']);
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('massages');
    }
};
