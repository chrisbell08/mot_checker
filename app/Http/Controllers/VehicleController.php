<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session, Redirect;

class VehicleController extends Controller {

	/**
	 * [__construct description]
	 * @param [type] $repository [description]
	 */
	public function __construct(  ) {
		$this->repository = app('App\Http\Interfaces\VehicleInterface');
	}

}