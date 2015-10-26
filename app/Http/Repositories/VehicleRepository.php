<?php namespace App\Http\Repositories;

use App\Http\Interfaces\VehicleInterface;
use App\Http\Models\Vehicle;

class VehicleRepository extends Repository implements VehicleInterface {

	/**
	 * [__construct description]
	 * @param [type] $model [description]
	 */
	public function __construct( Vehicle $model ) {
		$this->model = $model;
	}

	/*
     * Get the vehicle ID or create a new one if it doesn't exists
     *
     * @param $reg:string
     * @param $make:string
     * @param $userId:int
     *
     * @return object
     */
	public function getOrCreateVehicle($reg, $make, $userId)
	{
		// Check to see if vehicle exists to the user
		$vehicle = $this->model
							->where('reg', $reg)
							->where('user_id', $userId)
							->first();

		if(count($vehicle) > 0) {
			return $vehicle;
		} else {

			// Vehicle doesn't exists so create a new one
			$vehicle = new $this->model();
			$vehicle->user_id = $userId;
			$vehicle->make = strtoupper($make);
			$vehicle->reg = strtoupper($reg);
			$vehicle->save();

			return $vehicle;
		}
	}

	/*
	 * Get a list of vehicles assigned to the user id
	 *
	 * @param $id:int
	 * @return Eloquent
	 */
	public function getVechiclesByUser($id)
	{
		$vehicles = $this->model
							->with('latest_lookup')
							->where('user_id', $id)
							->get();

		foreach($vehicles as $vehicle) {
			$vehicle->icon = $this->getIcon($vehicle);
		}
		return $vehicles;
	}

	/*
	 * Get the vehicle by Id
	 *
	 * @param $id:int
	 * @return Eloquent
	 */
	public function getVehicleById($id)
	{
		$vehicle = $this->model
			->with('latest_lookup')
			->where('id', $id)
			->first();

		return $vehicle;
	}

	/*
	 * Add the manufacturer icon to the vehicle collection
	 *
	 * @param $vehicle:object
	 * @return object
	 */
	public function getIcon($vehicle)
	{
		$fileLocation = 'img/car_logos/' . strtolower($vehicle->make) . '.png';

		// TODO add exceptions in double barrelled name (eg mercedes-benz)
		if(file_exists($fileLocation)) {
			return '<img src="/img/car_logos/' . strtolower($vehicle->make) . '.png" class="vehicle-table__icon">';
		} else {
			return '<i class="fa fa-car"></i>';
		}
	}
}