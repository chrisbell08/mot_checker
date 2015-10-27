<?php namespace App\Http\Repositories;

use App\Http\Interfaces\VehicleLookupInterface;
use App\Http\Models\Vehicle;
use App\Http\Models\VehicleLookup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
		$lookup = $this->getLookup($reg);

		if ($lookup) {
			return $lookup;
		} else {
			return false;
		}
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

		// Customize the commands based on environment
		if(getenv('APP_ENV') === 'local' ) {
			putenv('PATH=' . getenv('PATH') . ':/usr/local/bin');
			putenv("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs");
			putenv("DYLD_LIBRARY_PATH");
			$command = "casperjs ../casper.js " . $reg . " " . $make . " " . $vehicleId . " 2>&1";
		} else {
			putenv("PHANTOMJS_EXECUTABLE=" . base_path() . "node_modules/phantomjs");
			$command = "sudo casperjs ../casper.js " . $reg . " " . $make . " " . $vehicleId . " 2>&1";
		}

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
		$vehicle = Vehicle::where('reg', $reg)
							->where('user_id', Auth::user()->id)
							->first();

		$lookup = $this->model->where('vehicle_id', $vehicle->id)->orderby('created_at')->first();

		if($lookup) {
			$lookup = $this->checkDates($lookup);
		}

		return $lookup;
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
	public function postLookup($tax, $mot, $details, $vehicleId)
	{
		// Post data to db
		$vehicleCheck = new $this->model;
		$vehicleCheck->vehicle_details = $details;
		$vehicleCheck->vehicle_id = $vehicleId;

			// Do we have an MOT record
			if($mot === "no-mot" || $details === 'failed') {
				$vehicleCheck->mot_due = Carbon::createFromDate(1900, 01, 01);
			} else {
				$vehicleCheck->mot_due = new carbon($mot);
			}

			// Is the car SORN
			if($tax === "sorn" || $details === 'failed') {
				$vehicleCheck->tax_due = Carbon::createFromDate(1900, 01, 01);
			} else {
				$vehicleCheck->tax_due = new carbon($tax);
			}

		$vehicleCheck->save();

		return;
	}

	/*
	 * Check if the mot or tax are expired
	 *
	 * @param VehicleLookup $lookup
	 * @return Elequent
	 */
	public function checkDates(VehicleLookup $lookup)
	{

		if($lookup->mot_due->isPast()) {
			$lookup->mot_expired = true;
		} else {
			$lookup->mot_expired = false;
		}

		if($lookup->tax_due->isPast()) {
			$lookup->tax_expired = true;
		}

		return $lookup;
	}
}