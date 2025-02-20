<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('controlled_access_stamps', function (Blueprint $table) {
            $table->unsignedBigInteger('psslog_id'); // Foreign key
            $table->char('survey_required', 1)->nullable();
            $table->text('reason')->nullable();
            $table->date('announce15')->nullable();
            $table->date('announce05')->nullable();
            $table->date('survey_completed')->nullable();
            $table->char('survey_reviewed', 1)->nullable();
            $table->string('arm', 100)->nullable();
            $table->timestamps();

            $table->primary('psslog_id');
            $table->foreign('psslog_id')->references('psslog_id')->on('stamps')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controlled_access_stamps');
    }
};
