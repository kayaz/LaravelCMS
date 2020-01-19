<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvestmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('investments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('slug')->nullable()->index('slug');
			$table->text('meta_description', 65535)->nullable();
			$table->string('meta_title')->nullable();
			$table->string('content_list')->nullable();
			$table->text('content', 65535);
			$table->string('email');
			$table->string('phone')->nullable();
			$table->string('office')->nullable();
			$table->string('address')->nullable();
			$table->string('thumb')->nullable();
			$table->string('logo')->nullable();
			$table->string('plan')->nullable();
			$table->text('html', 65535)->nullable();
			$table->text('cords', 65535)->nullable();
			$table->integer('typ');
			$table->integer('status')->nullable()->default(1);
			$table->integer('sort')->default(0);
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
		Schema::drop('investments');
	}

}
