<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePietroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pietro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('inwestycja_id');
            $table->tinyInteger('budynek');
            $table->tinyInteger('typ')->default('1');
            $table->string('nazwa', 255)->collation('utf8_unicode_ci');
            $table->string('slug', 255)->collation('utf8_unicode_ci');
            $table->string('numer', 255)->collation('utf8_unicode_ci');
            $table->string('plik', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('meta_opis', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('meta_tytul', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('zakres_powierzchnia', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('zakres_pokoje', 255)->collation('utf8_unicode_ci')->nullable();
            $table->string('zakres_cena', 255)->collation('utf8_unicode_ci')->nullable();
            $table->longText('html')->collation('utf8_unicode_ci')->nullable();
            $table->longText('cords')->collation('utf8_unicode_ci')->nullable();
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
        Schema::dropIfExists('pietro');
    }
}
