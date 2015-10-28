<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models\Vehicle;
use App\Http\Models\VehicleLookup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class VehicleLookupController extends Controller
{
    /**
     * [$viewPath description]
     * @var string
     */
    protected $viewPath = 'VehicleLookup.';

    /**
     * [__construct description]
     * @param [type] $repository [description]
     */
    public function __construct(VehicleLookup $model, Vehicle $vehicle)
    {
        $this->repository = app('App\Http\Interfaces\VehicleLookupInterface');
        $this->model = $model;
        $this->vehicleModel = $vehicle;
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
        // Set the user to 0 if not logged in (for api)
        (Auth::user())? $userId = Auth::user()->id : $userId = 0;

        $reg = str_replace(' ', '', Input::get('reg'));

        // Lookup details
        $lookup = $this->repository->newLookup($userId, $reg, Input::get('make'));

        if ($lookup) {
            return view::make($this->viewPath . 'partials.newLookup')->with('lookup', $lookup);
        } else {
            return view::make($this->viewPath . 'partials.newLookup');
        }
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

        if ($lookup) {
            $lookup = $this->repository->checkDates($lookup);
        }

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

        $vehicle->icon = $this->vehicleRepository->getIcon($vehicle);

        return view::make('partials.vehicleTable')->with('vehicle', $vehicle);
    }

    /**
     * Delete a lookup
     *
     * @param $id:int
     * @return
     */
    public function deleteLookup($id)
    {
        // Get the modal the delete was created on
        $lookupToDelete = $this->model->find($id);

        // Use that to find all other lookups with the same vehicle
        $lookups = $this->model->where('vehicle_id', $lookupToDelete->vehicle_id);

        // delete lookups
        foreach ($lookups as $lookup) {
            $lookup->delete();
        }

        // delete vehicle
        $vehicle = $this->vehicleModel->find($lookupToDelete->vehicle_id);
        $vehicle->delete();

        return;
    }
}
