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
        Schema::create('accesses', function (Blueprint $table) {
            $table->bigIncrements('psslog_id'); // Foreign key Primary Key
            $table->unsignedBigInteger('owning_stamp_id'); // Foreign key
            $table->string('full_name', 100)->nullable();
            $table->timestamp('time_in')->nullable();
            $table->timestamp('time_out')->nullable();
            $table->char('tld', 1)->nullable();
            $table->char('odh', 1)->nullable();
            $table->char('key_num', 3)->nullable();
            $table->unsignedBigInteger('sso_out')->nullable(); // Foreign key (references SSOTable)
            $table->unsignedBigInteger('sso_in')->nullable(); // Foreign key (references SSOTable)
            $table->string('ram', 20)->nullable();
            $table->timestamps();

            $table->primary('psslog_id');
            $table->foreign('psslog_id')->references('psslog_id')
                ->on('controlled_access_stamps')
                ->onDelete('cascade');
            $table->foreign('sso_out')->references('sso')->on('sso')
                ->onDelete('cascade');
            $table->foreign('sso_in')->references('sso')->on('sso')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesses');
    }
};
