<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // Optional: link to an auth user (nice if members can log in)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('first_name');
            $table->string('last_name');

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 10)->nullable();

            $table->string('phone', 25)->nullable();

            $table->date('date_of_initiation')->nullable();
            $table->date('birthday')->nullable();

            // stores path like: members/photos/abc123.jpg
            $table->string('photo_path')->nullable();

            $table->timestamps();

            $table->index(['last_name', 'first_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};