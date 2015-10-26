<?php namespace App\Http\Models;

use Eloquent;

class VehicleLookup extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'vehicle_lookups';

	/**
	 * [$guarded description]
	 * @var array
	 */
	protected $guarded = array( 'id' );

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'mot_due', 'tax_due', 'details'
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['created_at', 'updated_at', 'mot_due', 'tax_due'];


}