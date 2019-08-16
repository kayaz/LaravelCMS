<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUstawieniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     *
     *
        Nazwa strony

        Opis strony

        Słowa kluczowe

        Adres strony *
        Indeksowanie
     */
    public function up()
    {
        Schema::create('ustawienia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meta_nazwa_strony');
            $table->string('meta_opis_strony');
            $table->string('adres_strony');
            $table->string('indeksowanie_strony', 30);
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
        Schema::dropIfExists('ustawienia');
    }
}
