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
        Schema::create('restricted_access_stamps', function (Blueprint $table) {
            $table->unsignedInteger('psslog_id'); // Foreign key referencing stamps
            $table->char('Survey_Required', 1)->nullable();
            $table->string('Reason', 4000)->nullable();
            $table->date('Announce15')->nullable();
            $table->date('Announce05')->nullable();
            $table->char('Permission', 1)->nullable();
            $table->string('Shift_Leader', 100)->nullable();
            $table->char('Hall_valves', 1)->nullable();

            $table->primary('psslog_id');
            $table->foreign('psslog_id')->references('psslog_id')
                ->on('psslog'); // Assuming psslogs table name

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restricted_access_stamps');
    }
};
