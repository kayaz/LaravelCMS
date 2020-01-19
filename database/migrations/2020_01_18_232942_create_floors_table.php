<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFloorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('floors', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->boolean('investments_id');
			$table->boolean('building')->default(0);
			$table->boolean('typ')->default(1);
			$table->string('name');
			$table->string('slug')->index('slug');
			$table->string('number');
			$table->string('file')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('meta_title')->nullable();
			$table->string('area_range')->nullable();
			$table->string('rooms_range')->nullable();
			$table->string('price_range')->nullable();
			$table->text('html')->nullable();
			$table->text('cords')->nullable();
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
		Schema::drop('floors');
	}

}
