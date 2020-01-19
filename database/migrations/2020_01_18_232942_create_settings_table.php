<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('meta_title', 191);
			$table->string('meta_description', 191);
			$table->string('url', 191);
			$table->string('email')->nullable();
			$table->string('author')->nullable();
			$table->string('robots', 30);
			$table->timestamps();
			$table->string('social_fb')->nullable();
			$table->string('social_yt')->nullable();
			$table->string('social_insta')->nullable();
			$table->string('social_tw')->nullable();
			$table->string('social_lin')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
