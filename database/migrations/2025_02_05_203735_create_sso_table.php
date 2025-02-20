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
        Schema::create('sso', function (Blueprint $table) {
            $table->unsignedBigInteger('sso'); // Assuming this is the primary key
            $table->unsignedBigInteger('badge_id');
            $table->date('validated');
            $table->timestamps();
            $table->primary('sso'); // Explicitly define primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sso');
    }
};
