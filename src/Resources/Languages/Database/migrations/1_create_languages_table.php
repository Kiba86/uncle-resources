<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10);
            $table->unsignedInteger('orderWeight');
            $table->timestamps();
        });

        Schema::create('languages_i18n', function(Blueprint $table){
            $table->integer('language_id')->unsigned();
            $table->string('locale', 6);
            $table->string('name')->nullable();
            $table->primary(['language_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
        Schema::dropIfExists('languages_i18n');
    }
}
