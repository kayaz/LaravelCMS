<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buildings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('investments_id')->default(0);
			$table->string('name');
			$table->string('slug');
			$table->string('number', 3);
			$table->string('file')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('meta_title')->nullable();
			$table->string('area_range')->nullable();
			$table->string('rooms_range')->nullable();
			$table->string('price_range')->nullable();
			$table->text('html');
			$table->text('cords');
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
		Schema::drop('buildings');
	}

}
