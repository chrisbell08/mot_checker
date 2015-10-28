<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * [__construct description]
     * @param [type] $repository [description]
     */
    public function __construct()
    {
        $this->repository = app('App\Http\Interfaces\DashboardInterface');
        $this->vehicleRepository = app('App\Http\Interfaces\VehicleInterface');
        $this->vehicleLookupRepository = app('App\Http\Interfaces\VehicleLookupInterface');
    }

    /**
     * [list description]
     * @return [type] [description]
     */
    public function home()
    {
        $vehicles =  $this->vehicleRepository->getVechiclesByUser(Auth::user()->id);

        return view('home')->with('vehicles', $vehicles);
    }
}
