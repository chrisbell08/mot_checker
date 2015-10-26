<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Vehicle extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'vehicles';

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
		'make', 'reg', 'user_id'
	];

	/*
	 * Join with the vehicle lookups
	 *
	 * @param
	 * @return
	 */
	public function lookups()
	{
		return $this->hasMany('App\Http\Models\VehicleLookup');
	}

	/*
	 * Return only the latest lookup
	 */
	public function latest_lookup()
	{
		return $this->hasMany('App\Http\Models\VehicleLookup')->latest();
	}

}