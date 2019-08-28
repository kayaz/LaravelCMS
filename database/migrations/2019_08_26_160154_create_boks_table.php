<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boks', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nazwa', 255)->collation('utf8_unicode_ci');
            $table->string('tekst', 255)->collation('utf8_unicode_ci');
            $table->string('link', 255)->collation('utf8_unicode_ci');
            $table->string('plik', 255)->collation('utf8_unicode_ci')->nullable();
            $table->tinyInteger('sort')->default('0');
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
        Schema::dropIfExists('boks');
    }
}
