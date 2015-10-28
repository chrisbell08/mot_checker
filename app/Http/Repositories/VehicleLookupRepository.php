<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\VehicleLookupInterface;
use App\Http\Models\Vehicle;
use App\Http\Models\VehicleLookup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VehicleLookupRepository extends Repository implements VehicleLookupInterface
{
    /**
     * [$viewPath description]
     * @var string
     */
    protected $viewPath = 'VehicleLookup.';

    /**
     * [__construct description]
     * @param [type] $model [description]
     */
    public function __construct(VehicleLookup $model)
    {
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
    public function newLookup($userId, $reg, $make)
    {
        // Look for vehicle with matching user id and reg, if false create new one.
        $vehicle = $this->vehicleRepository->getOrCreateVehicle($reg, $make, $userId);

        // Create a new lookup row to post casper results into
        $lookup = new $this->model;
        $lookup->vehicle_id = $vehicle->id;
        $lookup->mot_due = Carbon::createFromDate(1900, 01, 01);
        $lookup->tax_due = Carbon::createFromDate(1900, 01, 01);
        $lookup->save();

        if ($this->casper($make, $reg, $lookup->id)) {
            return $lookup = $this->getLookup($lookup->id);
        } else {
            // Delete the lookup to keep the db tidy
            $lookup->delete();
            // TODO how to delete failed lookup Vehicles.. Cron job or on the fly?
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
    public function casper($make, $reg, $lookupId)
    {
        // Customize the commands based on environment
        if (getenv('APP_ENV') === 'local') {
            putenv('PATH=' . getenv('PATH') . ':/usr/local/bin');
            putenv("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs");
            putenv("DYLD_LIBRARY_PATH");
            $command = "casperjs ../casper.js " . $reg . " " . $make . " " . $lookupId . " 2>&1";
        } else {
            putenv("PHANTOMJS_EXECUTABLE=" . base_path() . "node_modules/phantomjs");
            $command = "sudo casperjs ../casper.js " . $reg . " " . $make . " " . $lookupId . " 2>&1";
        }

        // Run casperjs
        exec($command, $array);

        if (count($array) > 0 && $array[0] === 'failed') {
            return false;
        } else {
            return true;
        }
    }

    /*
     * Get the lookup results from DB
     *
     * @param $id:int
     *
     * @return
     */
    public function getLookup($id)
    {
        $lookup = $this->model->find($id);

        if ($lookup) {
            $lookup = $this->checkDates($lookup);
            return $lookup;
        } else {
            return false;
        }
    }

    /*
     * Post new lookup to the DB
     *
     * @param $mot:string
     * @param $tax:string
     * @param $details:string
     * @param $lookupId:int
     *
     * @return
     */
    public function postLookup($tax, $mot, $details, $lookupId)
    {
        $vehicleCheck = $this->model->find($lookupId);
        $vehicleCheck->vehicle_details = $details;

        if ($mot != "no-mot") {
            $vehicleCheck->mot_due = new carbon($mot);
        }
        if ($tax != 'sorn') {
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

        if ($lookup->mot_due->isPast()) {
            $lookup->mot_expired = true;
        } else {
            $lookup->mot_expired = false;
        }

        if ($lookup->tax_due->isPast()) {
            $lookup->tax_expired = true;
        }

        return $lookup;
    }
}
