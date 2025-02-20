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
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('attachment_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('psslog_id'); // Foreign key
            $table->string('name', 255)->nullable();
            $table->string('filename_orig', 255)->nullable();
            $table->string('mime_type', 80)->nullable();
            $table->integer('data_size')->nullable();
            $table->binary('data')->nullable(); // Use a more appropriate type if needed (e.g., BLOB)
            $table->timestamps();

            $table->foreign('psslog_id')->references('psslog_id')->on('psslog')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
