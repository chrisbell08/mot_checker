<?php namespace App\Http\Repositories;

use App\Http\Interfaces\VehicleLookupInterface;
use App\Http\Models\Vehicle;
use App\Http\Models\VehicleLookup;
use Carbon\Carbon;

class VehicleLookupRepository extends Repository implements VehicleLookupInterface {

	/**
	 * [$viewPath description]
	 * @var string
	 */
	protected $viewPath = 'VehicleLookup.';

	/**
	 * [__construct description]
	 * @param [type] $model [description]
	 */
	public function __construct( VehicleLookup $model) {
		$this->model = $model;
		$this->vehicleRepository = app('App\Http\Interfaces\VehicleInterface');
	}

	/*
	 * Perform a new vehicle lookup
	 *
	 * @param $userid:int - UserId performing the lookup
	 * @param $make:string
	 * @param $reg:string
	 *
	 */
	public function newLookup($userId, $reg, $make )
	{
		// Get the Vehicle
		$vehicle = $this->vehicleRepository->getOrCreateVehicle($reg, $make, $userId);

		// Launch Casper
		$this->casper($make, $reg, $vehicle->id);

		// Return Results
		return $lookup = $this->getLookup($reg);
	}

	/*
	 * Launch the casperJS cli
	 *
	 * @param $make:string
	 * @param $reg:string
	 * @param $$vehicleId:int
	 *
	 * @return
	 */
	public function casper($make, $reg, $vehicleId)
	{
		// Set some stuff for the cli to run
		putenv("PHANTOMJS_EXECUTABLE=" . base_path() . "node_modules/phantomjs");
		$command = "sudo casperjs ../casper.js " . $reg . " " . $make . " " . $vehicleId . " 2>&1";

		// Run casperjs cli with args
		echo shell_exec($command);

		return;
	}

	/*
	 * Get the lookup results from DB
	 *
	 * @param $make:string
	 * @param $reg:string
	 *
	 * @return
	 */
	public function getLookup($reg)
	{
		// Get the vehicle
		$vehicle = Vehicle::where('reg', $reg)->first();

		// Get newest instance of the lookup from DB with matching reg and make
		return $this->model->where('vehicle_id', $vehicle->id)->orderby('created_at')->first();
	}

	/*
	 * Post new lookup to the DB
	 *
	 * @param $mot:string
	 * @param $tax:string
	 * @param $details:string
	 * @param $vehicleId:int
	 *
	 * @return
	 */
	public function postLookup($mot, $tax, $details, $vehicleId)
	{
		// Convert string dates to carbon
		$motDue = new carbon($mot);
		$taxDue = new carbon($tax);

		// Post data to db
		$vehicleCheck = new $this->model;
		$vehicleCheck->mot_due = $motDue;
		$vehicleCheck->tax_due = $taxDue;
		$vehicleCheck->vehicle_details = $details;
		$vehicleCheck->vehicle_id = $vehicleId;
		$vehicleCheck->save();

		return;
	}
}