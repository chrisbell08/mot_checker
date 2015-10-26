
{!! var_dump($errors) !!}

{!! Form::open( array( 'route' => 'vehicles.add.process' ) ) !!}

	

	{!! Form::submit( 'Create', array( "class" => "btn btn-primary" )) !!}


{!! Form::close() !!}