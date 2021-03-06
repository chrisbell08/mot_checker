<?php namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
use Validator;
use View;
use Session;

abstract class Repository
{

    /**
     * [$model description]
     * @var [type]
     */
    protected $model;

    /**
     * [$viewPath description]
     * @var string
     */
    protected $viewPath = '';

    /**
     * [$rules description]
     * @var array
     */
    protected $rules = array();

    /**
     * [__construct description]
     * @param Model $model [description]
     */
    public function __construct( Model $model ) {
        $this->model = $model;
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create( $array ) {
        return $this->model->create( $array );
    }

    /**
     * [update description]
     * @param  [type] $id    [description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function update( $id, $array ) {
        $model = $this->find( $id );
        return $model->update( $array );
    }

    /**
     * [failsValidation description]
     * @param  Input  $input [description]
     * @return [type]        [description]
     */
    public function failsValidation( $input ) {
        $v = Validator::make( $input, $this->rules );
        if( $v->fails() ) return $v->errors();
        return false;
    }

    /**
     * [find description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function find( $id ) {
        return $this->model->findorfail( $id );
    }

    /**
     * [view description]
     * @param  [type] $view [description]
     * @return [type]       [description]
     */
    public function view( $view, $data = array() ) {
        return View::make( $this->viewPath . $view, $data );
    }

    /**
     * [paginate description]
     * @param  integer $amount [description]
     * @return [type]          [description]
     */
    public function paginate( $amount = 10 ) {
        return $this->model->paginate( $amount );
    }

    /**
     * [success description]
     * @param  [type]  $message [description]
     * @param  boolean $type    [description]
     * @return [type]           [description]
     */
    public function success( $message, $type = false ) {
        Session::flash( 'success' . ( $type ? "_{$type}" : '' ), $message );
    }

}