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
        Schema::create('stamps', function (Blueprint $table) {
            $table->unsignedBigInteger('psslog_id'); // Foreign key
            $table->string('stamp_type', 20);
            $table->foreign('psslog_id')->references('psslog_id')->on('psslog')
                ->onDelete('cascade');

            $table->primary('psslog_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stamps');
    }
};
