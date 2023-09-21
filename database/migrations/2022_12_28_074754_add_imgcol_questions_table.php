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
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('is_img');
            $table->string('quesimg')->nullable();
            $table->string('optAimg')->nullable();
            $table->string('optBimg')->nullable();
            $table->string('optCimg')->nullable();
            $table->string('optDimg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('is_img');
            $table->dropColumn('quesimg');
            $table->dropColumn('optAimg');
            $table->dropColumn('optBimg');
            $table->dropColumn('optCimg');
            $table->dropColumn('optDimg');
        });
    }
};
