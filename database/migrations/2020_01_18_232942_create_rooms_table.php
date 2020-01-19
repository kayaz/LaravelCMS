<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('floor_id');
			$table->string('number')->nullable();
			$table->integer('status')->default(0);
			$table->integer('typ')->default(1);
			$table->string('name');
			$table->string('meta_title')->nullable();
			$table->text('meta_description', 65535)->nullable();
			$table->string('slug')->index('slug');
			$table->string('area', 10)->nullable();
			$table->integer('area_search')->nullable();
			$table->string('price', 50)->nullable();
			$table->string('price_m')->nullable();
			$table->integer('price_search')->nullable();
			$table->integer('rooms')->nullable();
			$table->string('windows')->nullable();
			$table->text('content', 65535)->nullable();
			$table->text('cords');
			$table->text('html');
			$table->string('file')->nullable();
			$table->string('pdf')->nullable();
			$table->timestamps();
			$table->integer('sort')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rooms');
	}

}
