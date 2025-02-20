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
        Schema::create('psslog', function (Blueprint $table) {
            $table->bigIncrements('psslog_id'); // Auto-incrementing primary key
            $table->string('title', 255);
            $table->timestamp('entry_timestamp');
            $table->unsignedBigInteger('entry_maker')->nullable(); // Foreign key (references a users table likely)
            $table->text('comments')->nullable();
            $table->string('entry_type', 12)->nullable();
            $table->string('area', 20)->nullable();
            $table->timestamps();

            // Indexes
            $table->index('entry_maker');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psslog');
    }
};
