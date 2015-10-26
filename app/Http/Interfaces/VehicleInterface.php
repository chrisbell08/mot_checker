<?php namespace app\Http\Interfaces;

interface VehicleInterface {
    /*
     * Get the vehicle ID or create a new one if it doesn't exists
     *
     * @param $reg:string
     * @param $make:string
     * @param $userId:int
     *
     * @return Eloquent
     */
    public function getOrCreateVehicle($reg, $make, $userId);

    /*
     * Get a list of vehicles assigned to the user id
     *
     * @param $id:int
     * @return Eloquent
     */
    public function getVechiclesByUser($id);

    /*
     * Get the vehicle by Id
     *
     * @param $id:int
     * @return Eloquent
     */
    public function getVehicleById($id);
}