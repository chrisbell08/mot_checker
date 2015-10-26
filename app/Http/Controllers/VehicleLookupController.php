<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models\Vehicle;
use App\Http\Models\VehicleLookup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Session, Redirect;

class VehicleLookupController extends Controller {

	/**
	 * [$viewPath description]
	 * @var string
	 */
	protected $viewPath = 'VehicleLookup.';

	/**
	 * [__construct description]
	 * @param [type] $repository [description]
	 */
	public function __construct(VehicleLookup $model ) {
		$this->repository = app('App\Http\Interfaces\VehicleLookupInterface');
		$this->model = $model;
		$this->vehicleRepository = app('App\Http\Interfaces\VehicleInterface');
	}

	/*
	 * New lookup Form
	 *
	 * @param
	 *
	 * @return view
	 */
	public function newLookupForm()
	{
		return view::make($this->viewPath . 'new');
	}

	/*
	 * Receive post data for new lookup and return results
	 *
	 * @param $_POST['reg']:string
	 * @param $_POST['make']:string
	 *
	 * @return JSON
	 */
	public function postNewLookup()
	{
		// Set the user to 0 if not logged in, this will create a new user
		(Auth::user())? $userId = Auth::user()->id : $userId = 0;

		// Lookup details
		$lookup = $this->repository->newLookup($userId, Input::get('reg'), Input::get('make'));

		return view::make($this->viewPath . 'partials.newLookup')->with('lookup', $lookup);
	}

	/*
	 * Get the vehicle details from the id
	 *
	 * @param $id:int
	 * @return view
	 */
	public function getVehicleDetails($id)
	{
		$lookup = $this->model->findorFail($id);

		return view::make($this->viewPath . 'partials.newLookup')->with('lookup', $lookup);
	}

	/*
	 * Refresh a lookup by the ID
	 *
	 * @param $id:int
	 * @return view
	 */
	public function refreshLookup($id)
	{
		// Get the lookup collection
		$lookup = $this->model->findOrFail($id);

		// Get the vehcile to pass to casperjs
		$vehicle = Vehicle::findOrFail($lookup->vehicle_id);

		// perform lookup
		$this->repository->newLookup(Auth::user()->id, $vehicle->reg, $vehicle->make);

		$vehicle = $this->vehicleRepository->getVehicleById($vehicle->id);

		return view::make('partials.vehicleTable')->with('vehicle', $vehicle);
	}
}