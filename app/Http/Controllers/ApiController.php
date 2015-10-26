<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;

class ApiController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | API Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles all the API requests
    |
    */


    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->vehicleLookupRepository = app('App\Http\Interfaces\VehicleLookupInterface');;
    }

    /**
     * Post results from Casper to Vehice Lookup repo
     *
     * @param $_POST['mot']
     * @param $_POST['tax']
     * @param $_POST['details']
     *
     * @return
     */
    protected function casperPost()
    {
        $mot = Input::get('mot');
        $tax = Input::get('tax');
        $details = Input::get('details');
        $vehicleId = Input::get('vehicleId');

        $this->vehicleLookupRepository->postLookup($tax, $mot, $details, $vehicleId);

        return;
    }
}
