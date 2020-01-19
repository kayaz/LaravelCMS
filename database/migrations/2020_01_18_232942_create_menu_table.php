<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_id')->default(0);
			$table->integer('typ')->default(0)->comment('0 - page, 1 - form, 2 - module, 3 - link');
			$table->string('title', 150)->default('');
			$table->string('slug')->nullable();
			$table->text('content', 65535)->nullable();
			$table->string('url')->nullable();
			$table->string('url_target', 20)->nullable();
			$table->integer('lock')->default(0);
			$table->text('meta_description')->nullable();
			$table->string('meta_title')->nullable();
			$table->integer('menu')->default(1);
			$table->timestamps();
			$table->string('file')->nullable();
			$table->text('uri', 65535)->nullable();
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
		Schema::drop('menu');
	}

}
