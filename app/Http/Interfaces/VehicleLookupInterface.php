<?php namespace app\Http\Interfaces;

interface VehicleLookupInterface {

    /*
     * New vehicle lookup
     *
     * @param $userid: int - User ID performing the lookup
     * @param $make:string
     * @param $model:string
     *
     * @return
     */
    public function newLookup($userId, $reg, $make);

    /*
     * Post new lookup to db
     *
     * @param $mot:string
     * @param $tax:string
     * @param $details:string
     * @param $vehicleId:int
     *
     * @return
     */
    public function postLookup($mot, $tax, $details, $vehicleId);

}