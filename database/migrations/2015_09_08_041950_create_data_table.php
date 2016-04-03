<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('meter_id')->unsigned();
			$table->string('parameter_name');
			$table->string('value');
			$table->dateTime('DateTime');

			$table->timestamps();

			$table->foreign('meter_id')
				  ->references('id')
				  ->on('companies')
					->onUpdate('cascade')
				  ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data');
	}

}
