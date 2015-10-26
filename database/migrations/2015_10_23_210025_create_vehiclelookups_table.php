<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleLookupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicle_lookups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->date('mot_due');
			$table->date('tax_due');
			$table->text('vehicle_details');
			$table->integer('vehicle_id');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vehiclelookups');
	}

}