
{!! var_dump($errors) !!}

{!! Form::model( $model, array( 'route' => array( 'vehicles.edit.process', $model->id ) ) ) !!}

	


	{!! Form::submit( 'Update', array( "class" => "btn btn-primary" )) !!}


{!! Form::close() !!}