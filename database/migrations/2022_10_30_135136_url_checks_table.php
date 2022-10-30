<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('url_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->smallInteger('status_code')->nullable();
            $table->string('h1', 1000)->nullable();
            $table->string('title', 1000)->nullable();
            $table->string('description', 2000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_checks');
    }
};
